<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Size;
use App\Models\Color;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Variation;
use App\Models\Stock;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status',1)->latest()->simplepaginate(20);
        $categoryId = Category::pluck('parent_id');
        $categories = Category::whereNotIn('id',$categoryId)->get();
        return view('admin.products.index',compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all();
        $categoryId = Category::pluck('parent_id');
        $categories = Category::whereNotIn('id',$categoryId)->get();
  
        return view('admin.products.create',compact('categories','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function imageUpload(Request $request){
        return $request->all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function variationProduct(Request $request){
        return $request->all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {  
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string','max:100','unique:products,name'],
            'code' => ['nullable','string','max:30'],
            'affiliate_link' => ['nullable','string'],
            'model' => ['nullable','string'],
            'price' => ['required',],
            'image' => ['required','string'],
            'front_side_image' => ['required','string'],
            'right_side_image' => ['required','string'],
            'left_side_image' => ['required','string'],
            'back_side_image' => ['required','string'],
            'unit_id' => ['required','integer'],
            'status' => ['required','integer'],
            'description' => ['required','string'],
            'discount_amount' => ['nullable','integer'],
            'discount_percentage' => ['nullable','integer'],           
        ]);

        if ($validator->fails()) {
            return $validator->validate()->withInput();
        } else {
            $product->name = $request->name;
            $product->code = $request->code;
            $product->model = $request->model;
            $product->slug = Str::slug($request->name."-".$request->model."-".$product->code);
            $product->affiliate_link = $request->affiliate_link;
            $product->price = $request->price;
            
            $product->image = $request->image;
            $product->left_side_image = $request->left_side_image;
            $product->back_side_image = $request->back_side_image;
            $product->front_side_image = $request->front_side_image;
            $product->right_side_image = $request->right_side_image;
            
           
            $product->quantity = $request->quantity;
            $product->unit_id = $request->unit_id;
            $product->status = $request->status;
            $product->description = $request->description;
                
            if(isset($request->discount_amount) && $request->discount_amount > 0) {
                $discountAmount = $product->discount_amount = $request->discount_amount;
                $salePrice = $request->price - $discountAmount;
                $product->sale_price = $salePrice;
            }elseif(isset($request->discount_percentage) && $request->discount_percentage > 0) {
                $discountPercent = $product->discount_percentage = $request->discount_percentage;
                $discountAmount = $product->price * ($discountPercent / 100);
                $salePrice = $request->price - $discountAmount;
                $product->sale_price = $salePrice;
            }else {
                $product->sale_price = $request->sale_price;
            }
       
            // $product->meta_title = $request->meta_title;
            // $product->meta_tags = empty($request->hidden_meta_tags) ? null : json_encode(explode(",",$request->hidden_meta_tags));
            // $product->meta_description = $request->meta_description;

            if($product->save()) {
                $product->categories()->attach($request->category);
               
                $options = $request->options;                
                 
                $attributes = [];
                        
                foreach($options as $key => $name){
                    $attributes[$key] = $request->$key;            
                }

                foreach($attributes as $key => $attributeValues){
                    if(!Option::where('product_id',$product->id)->where('name',$key)->exists()){
                        $input['product_id'] = $product->id;
                        $input['name'] = ucfirst($key);
                        $option = Option::create($input);
                    }
                    
                    foreach($attributeValues as $value){
                        if($value != null && !OptionValue::where('option_id',$option->id)->where('value',$value)->exists()){
                            $inputvalue['option_id'] = $option->id;
                            $inputvalue['product_id'] = $product->id;
                            $inputvalue['value'] = $value;
                            OptionValue::create($inputvalue);
                        }
                       
                    }
                }            
                
                Product::where('id',$product->id)->update(['has_option' => 1]);

                $productOptionSize = Option::where('product_id',$product->id)->where('name',$options['size'])->first();
                $productOptionColor = Option::where('product_id',$product->id)->where('name',$options['color'])->first();

                $optionValueSizes = OptionValue::where('option_id',$productOptionSize->id)->pluck('id')->toArray();
                $optionValueColors = OptionValue::where('option_id',$productOptionColor->id)->pluck('id')->toArray();
 
                $codeCombinationArray = [
                    'product' => [$product->id],
                    'size' => $optionValueSizes,
                    'color' => $optionValueColors,
                ];

                // Creating code for each variation
                $codeCombinations = $this->variations($codeCombinationArray);         
                $codes = [];

                foreach($codeCombinations as $code){
                    $codes[] = $code['product'].$code['size'].$code['color'];
                }
                //product variations by size and color
                $variationArray = [ 
                    'size' => $request->size,
                    'color' => $request->color,
                    'price' => [$product->price],
                ];
                
                
                $productVariations = $this->variations($variationArray);

                //Code merge with product variations
                $variations = [];
                foreach($productVariations as $vkey => $variation){
                    foreach($codes as $ckey => $code){
                        if($vkey == $ckey){
                            $variations[] = [
                                'size' => $variation['size'],
                                'color' => $variation['color'],
                                'price' => $variation['price'],
                                'code' => $code
                            ];
                        }
                    }
                }
                
                foreach($variations as $key => $variation){
                    $inputVariation['product_id'] = $product->id;
                    $inputVariation['sku'] = '';
                    $inputVariation['code'] = $variation['code'];
                    $inputVariation['name'] = $variation['size'].'/'.$variation['color'];
                    $inputVariation['price'] = $variation['price'];
                    $inputVariation['discount_amount'] = 0;
                    $inputVariation['discount_percentage'] = 0;
                    $inputVariation['sale_price'] = $product->sale_price;
                    $inputVariation['quantity'] = $inputStock['quantity'] = 0;
                    $inputVariation['is_default'] = $key == 0 ? 1 : 0;
                    $productVariation = Variation::create($inputVariation);
                    // $inputStock['variation_id'] = $productVariation->id;
                    // $inputStock['product_id'] = $product->id;
                    // $inputStock['status'] = 1;
                    // Stock::create($inputStock);
                }

                Session::flash('success','Product has been saved successfully.');
            } else {
                Session::flash('warning','Something is wrong when saving product.');
            }
            return redirect()->route('admin.variations.edit',$product->id);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function storeAttribute(Request $request, $id)
    {
        $arr = [
            'size'  => ['XS', 'S', 'M'],
            'color' => ['yellow', 'brown', 'white'],
            'weight'=> [
                'light' => [
                    'super',
                    'medium'
                ],
                'normal',
                'heavy' => [
                    'regular',
                    'most', 
                    'overload'
                ]
            ]
        ];

        
    }

    public function traverse($array, $parent_ind) {
        $r = [];
        $pr = '';

        if(!is_numeric($parent_ind)) {
            $pr = $parent_ind.'-';
        }

        foreach ($array as $ind => $el) {
            if (is_array($el)) {
                $r = array_merge($r, $this->traverse($el, $pr.(is_numeric($ind) ? '' : $ind)));
            } elseif (is_numeric($ind)) {
                $r[] = $pr.$el;
            } else {
                $r[] = $pr.$ind.'-'.$el;
            }
        }

        return $r;
    }

    public function variations($array) {
        if (empty($array)) {
            return [];
        }
    
        //1. Go through entire array and transform elements that are arrays into elements, collect keys
        $keys = [];
        $size = 1;
    
        foreach ($array as $key => $elems) {
            if (is_array($elems)) {
                $rr = [];
    
                foreach ($elems as $ind => $elem) {
                    if (is_array($elem)) {
                        $rr = array_merge($rr, $this->traverse($elem, $ind));
                    } else {
                        $rr[] = $elem;
                    }
                }
    
                $array[$key] = $rr;
                $size *= count($rr);
            }
    
            $keys[] = $key;
        }
    
        //2. Go through all new elems and make variations
        $rez = [];
        for ($i = 0; $i < $size; $i++) {
            $rez[$i] = [];
    
            foreach ($array as $key => $value) {
                $current = current($array[$key]);
                $rez[$i][$key] = $current;
            }
    
            foreach ($keys as $key) {
                if (!next($array[$key])) {
                    reset($array[$key]);
                } else {
                    break;
                }
            }
        }
    
        return $rez;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('product.show',compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function attributesEdit($product){
        $product = Product::findOrFail($product);
        // $optionSize = Option::where('product_id',$id)->where('name','size')->first();
        // $optionColor = Option::where('product_id',$id)->where('name','color')->first();
        return view('admin.attributes.edit',compact('product'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function attributesUpdate(Request $request, $product){
        
        $options = $request->options;
        $optionSizeExists = Option::where('product_id',$product)->where('name',$options['size'])->exists();
        $optionColorExists = Option::where('product_id',$product)->where('name',$options['color'])->exists();
 
        if(!$optionSizeExists && !$optionColorExists){
            foreach($options as $option){
                $input['product_id'] = $product;
                $input['name'] = ucfirst($option);
                $option = Option::create($input);
            }
        }

        $optionSizes = Option::where('product_id',$product)->where('name',$options['size'])->first();
        $optionColors = Option::where('product_id',$product)->where('name',$options['color'])->first();

        $attributeSizeValues = OptionValue::where('product_id',$product)->where('option_id',$optionSizes->id)->pluck('id')->toArray();
        $attributeColorValues = OptionValue::where('product_id',$product)->where('option_id',$optionColors->id)->pluck('id')->toArray();

        $productAttributesSizes = [];
        foreach($attributeSizeValues as $attributeValue){
            $valueSize = lcfirst($optionSizes->name).$attributeValue;
            $requestValue = $request->$valueSize;
            if($requestValue != null){
                $productAttributesSizes[$attributeValue] = $requestValue;
            }
        }
        
        
        $productAttributesColors = [];
        foreach($attributeColorValues as $attributeValue){
            $valueColor = lcfirst($optionColors->name).$attributeValue;
            $requestValue = $request->$valueColor;
            if($requestValue != null){
                $productAttributesColors[$attributeValue] = $requestValue;
            }
        }

        foreach($productAttributesSizes as $key => $size){
            OptionValue::where('product_id',$product)->where('id',$key)->update(['value'=>$size]);
        }
        foreach($productAttributesColors as $key => $color){
            OptionValue::where('product_id',$product)->where('id',$key)->update(['value'=>$color]);
        }

        //////////////////////
        
        $existOptionSizes = [];
        foreach($productAttributesSizes as $key => $productSize){
            if($productSize != null){
                $existOptionSizes[] = $key;
            } 
        } 

        $existOptionColors = [];
        foreach($productAttributesColors as $key => $productColor){
            if($productColor != null){
                $existOptionColors[] = $key;
            } 
        } 
        
        $ifSizeAttributeDeletedValues = OptionValue::where('product_id',$product)->whereNotIn('id',$existOptionSizes)->where('option_id',$optionSizes->id)->pluck('id')->toArray();
        $ifColorAttributeDeletedValues = OptionValue::where('product_id',$product)->whereNotIn('id',$existOptionColors)->where('option_id',$optionColors->id)->pluck('id')->toArray();
         
        if(count($ifSizeAttributeDeletedValues) > 0 || count($ifColorAttributeDeletedValues) > 0) {

            if(count($ifSizeAttributeDeletedValues) > 0 && count($ifColorAttributeDeletedValues) == 0) {
                $ifSizeColorCodeDeletedCombinationArray = [
                    'product' => [$product],
                    'size' => $ifSizeAttributeDeletedValues, 
                    'color' => $attributeColorValues,
                ];
                $deletedSizeColorCodeCombinations = $this->variations($ifSizeColorCodeDeletedCombinationArray); 
                $deleteSizeColorCombinations = [];
                foreach($deletedSizeColorCodeCombinations as $deleteSizeColorCode){
                    $deleteSizeColorCombinations[] = $deleteSizeColorCode['product'].$deleteSizeColorCode['size'].$deleteSizeColorCode['color'];
                }
                Variation::where('product_id',$product)->whereIn('code',$deleteSizeColorCombinations)->delete();
                OptionValue::where('product_id',$product)->where('id',$ifSizeAttributeDeletedValues)->delete();
            }

            if(count($ifSizeAttributeDeletedValues) == 0 && count($ifColorAttributeDeletedValues) > 0){
                $ifColorSizeCodeDeletedCombinationArray = [
                    'product' => [$product],
                    'size' => $attributeSizeValues, 
                    'color' => $ifColorAttributeDeletedValues,
                ];

                // Creating code for each variation
                
                $deletedColorSizeCodeCombinations = $this->variations($ifColorSizeCodeDeletedCombinationArray); 
                $deleteColorSizeCombinations = [];
                foreach($deletedColorSizeCodeCombinations as $deleteColorSizeCode){
                    $deleteColorSizeCombinations[] = $deleteColorSizeCode['product'].$deleteColorSizeCode['size'].$deleteColorSizeCode['color'];
                }
                //dd($deletedColorSizeCodeCombinations);
                
                Variation::where('product_id',$product)->whereIn('code',$deleteColorSizeCombinations)->forceDelete();
                OptionValue::where('product_id',$product)->where('id',$ifColorAttributeDeletedValues)->forceDelete();
            }

            if(count($ifSizeAttributeDeletedValues) > 0 && count($ifColorAttributeDeletedValues) > 0){
                $ifSizeColorCodeDeletedCombinationArray = [
                    'product' => [$product],
                    'size' => $ifSizeAttributeDeletedValues,//all size ids
                    'color' => $attributeColorValues,
                ];
                $deletedSizeColorCodeCombinations = $this->variations($ifSizeColorCodeDeletedCombinationArray); 
                $deleteSizeColorCombinations = [];
                foreach($deletedSizeColorCodeCombinations as $deleteSizeColorCode){
                    $deleteSizeColorCombinations[] = $deleteSizeColorCode['product'].$deleteSizeColorCode['size'].$deleteSizeColorCode['color'];
                }
                Variation::where('product_id',$product)->whereIn('code',$deleteSizeColorCombinations)->forceDelete();

                $ifColorSizeCodeDeletedCombinationArray = [
                    'product' => [$product],
                    'size' => $attributeSizeValues, 
                    'color' => $ifColorAttributeDeletedValues,
                ];

                // Creating code for each variation
                
                $deletedColorSizeCodeCombinations = $this->variations($ifColorSizeCodeDeletedCombinationArray); 
                $deleteColorSizeCombinations = [];
                foreach($deletedColorSizeCodeCombinations as $deleteColorSizeCode){
                    $deleteColorSizeCombinations[] = $deleteColorSizeCode['product'].$deleteColorSizeCode['size'].$deleteColorSizeCode['color'];
                }
                //dd($deletedColorSizeCodeCombinations);
                
                Variation::where('product_id',$product)->whereIn('code',$deleteColorSizeCombinations)->forceDelete();
                OptionValue::where('product_id',$product)->where('id',$ifSizeAttributeDeletedValues)->forceDelete();
                OptionValue::where('product_id',$product)->where('id',$ifColorAttributeDeletedValues)->forceDelete();
            }
            
        }   
        //dd($existOptionColors);
        ////////////////////////////

        if($request->size != null || $request->color != null){
            $optionSizes = Option::where('product_id',$product)->where('name',$options['size'])->first();
            $optionColors = Option::where('product_id',$product)->where('name',$options['color'])->first();
            $sizeValueIds = [];
            $colorValueIds = [];
            if($request->color != null){
                foreach($request->color as $key => $value){
                    if($value != null && !OptionValue::where('product_id',$product)->where('value',$value)->exists()){
                        $inputvalue['option_id'] = $optionColors->id;
                        $inputvalue['product_id'] = $product;
                        $inputvalue['value'] = $value;
                        $optionValue = OptionValue::create($inputvalue);     
                        $colorValueIds[] = $optionValue->id;               
                    }
                }            
            }
            if($request->size != null){
                foreach($request->size as $key => $value){
                    if($value != null && !OptionValue::where('product_id',$product)->where('value',$value)->exists()){
                        $inputvalue['option_id'] = $optionSizes->id;
                        $inputvalue['product_id'] = $product;
                        $inputvalue['value'] = $value;
                        $optionValue = OptionValue::create($inputvalue);    
                        $sizeValueIds[] = $optionValue->id;
                    }
                }            
            }
        
            $optionValueSizesAll = OptionValue::where('product_id',$product)->where('option_id',$optionSizes->id)->pluck('value')->toArray();
            $optionValueColorsNew = OptionValue::where('product_id',$product)->where('option_id',$optionColors->id)->whereIn('id',$colorValueIds)->pluck('value')->toArray();
            
            $optionValueSizesAllIds = OptionValue::where('product_id',$product)->where('option_id',$optionSizes->id)->pluck('id')->toArray();
            $optionValueColorsNewIds = OptionValue::where('product_id',$product)->where('option_id',$optionColors->id)->whereIn('id',$colorValueIds)->pluck('id')->toArray();

            // Step:2 Second process for New sizes with old colors 
            $oldOptionValueColorValues = OptionValue::where('product_id',$product)->where('option_id',$optionColors->id)->whereNotIn('id',$colorValueIds)->pluck('value')->toArray();
            $newOptionValueSizeValues = OptionValue::where('product_id',$product)->where('option_id',$optionSizes->id)->whereIn('id',$sizeValueIds)->pluck('value')->toArray();
            $oldOptionValueColorIds = OptionValue::where('product_id',$product)->where('option_id',$optionColors->id)->whereNotIn('id',$colorValueIds)->pluck('id')->toArray();
            $newSizeOptionValueIds = OptionValue::where('product_id',$product)->where('option_id',$optionSizes->id)->whereIn('id',$sizeValueIds)->pluck('id')->toArray();
            
            //dd($newSizeOptionValueIds);
            $product = Product::findOrFail($product);

            $newColorAllSizeCodeCombinationArray = [
                'product' => [$product->id],
                'size' => $optionValueSizesAllIds,//all size ids
                'color' => $optionValueColorsNewIds,//new color ids
            ];
            //Step 2
            $oldColorNewSizeCodeCombinationArray = [
                'product' => [$product->id],
                'size' => $newSizeOptionValueIds,//all size ids
                'color' => $oldOptionValueColorIds,//new color ids
            ];

            // Creating code for each variation
            $newColorAllSizeCodeCombinations = $this->variations($newColorAllSizeCodeCombinationArray);     
            // Step 2
            $oldColorNewSizeCodeCombinations = $this->variations($oldColorNewSizeCodeCombinationArray);     
           
            //dd($oldColorNewSizeCodeCombinationArray);
            
            $newColorAllSizesCodes = [];
            $oldColorNewSizeCodes = [];

            foreach($newColorAllSizeCodeCombinations as $code){
                $newColorAllSizesCodes[] = $code['product'].$code['size'].$code['color'];
            }
            // Step 2
            foreach($oldColorNewSizeCodeCombinations as $code){
                $oldColorNewSizeCodes[] = $code['product'].$code['size'].$code['color'];
            }
            //product variations by size and color
            $newColorAllSizeVariationArray = [ 
                'size' => $optionValueSizesAll,
                'color' => $optionValueColorsNew,
                'price' => [$product->price],
            ];
            // Step 2
            $oldColorNewSizeVariationArray = [ 
                'size' => $newOptionValueSizeValues,
                'color' => $oldOptionValueColorValues,
                'price' => [$product->price],
            ];
            
            $newColorAllSizeProductVariations = $this->variations($newColorAllSizeVariationArray);
            $oldColorNewSizeProductVariations = $this->variations($oldColorNewSizeVariationArray);
 
            //Code merge with product variations
            $newColorAllSizeVariations = [];
            foreach($newColorAllSizeProductVariations as $vkey => $variation){
                foreach($newColorAllSizesCodes as $ckey => $code){
                    if($vkey == $ckey){
                        $newColorAllSizeVariations[] = [
                            'size' => $variation['size'],
                            'color' => $variation['color'],
                            'price' => $variation['price'],
                            'code' => $code
                        ];
                    }
                }
            }
            //Step 2
            $oldColorNewSizeVariations = [];
            foreach($oldColorNewSizeProductVariations as $vkey => $variation){
                foreach($oldColorNewSizeCodes as $ckey => $code){
                    if($vkey == $ckey){
                        $oldColorNewSizeVariations[] = [
                            'size' => $variation['size'],
                            'color' => $variation['color'],
                            'price' => $variation['price'],
                            'code' => $code
                        ];
                    }
                }
            }

            
            foreach($newColorAllSizeVariations as $key => $variation){
                $inputVariation['product_id'] = $product->id;
                $inputVariation['sku'] = '';
                $inputVariation['code'] = $variation['code'];
                $inputVariation['name'] = $variation['size'].'/'.$variation['color'];
                $inputVariation['price'] = $variation['price'];
                $inputVariation['discount_amount'] = 0;
                $inputVariation['discount_percentage'] = 0;
                $inputVariation['sale_price'] = $product->sale_price;
                $inputVariation['quantity'] = $inputStock['quantity'] = 0;
                $productVariation = Variation::create($inputVariation);
                // $inputStock['variation_id'] = $productVariation->id;
                // $inputStock['product_id'] = $product->id;
                // $inputStock['status'] = 1;
                //Stock::create($inputStock);
            }
            //Step 2
            foreach($oldColorNewSizeVariations as $key => $variation){
                $inputVariation['product_id'] = $product->id;
                $inputVariation['sku'] = '';
                $inputVariation['code'] = $variation['code'];
                $inputVariation['name'] = $variation['size'].'/'.$variation['color'];
                $inputVariation['price'] = $variation['price'];
                $inputVariation['discount_amount'] = 0;
                $inputVariation['discount_percentage'] = 0;
                $inputVariation['sale_price'] = $product->sale_price;
                $inputVariation['quantity'] = $inputStock['quantity'] = 0;
                $productVariation = Variation::create($inputVariation);
                // $inputStock['variation_id'] = $productVariation->id;
                // $inputStock['product_id'] = $product->id;
                // $inputStock['status'] = 1;
                //Stock::create($inputStock);
            }
        }

        return redirect()->route('admin.variations.edit',$product)->with('Product attributes has been updated!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function variationsEdit($product){
        $variations = Variation::where('product_id',$product)->get();
        return view('admin.variations.edit',compact('variations','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function variationsUpdate(Request $request, $product){
        $variationIds = Variation::where('product_id',$product)->pluck('id')->toArray();
        
        $variations = [];
        $count = 0;
        foreach($variationIds as $variationId){
            $variant_id = 'variant_id'.$variationId;
            $image = 'image'.$variationId;
            $sku = 'sku'.$variationId;
            $price = 'price'.$variationId;
            $sale_price = 'sale_price'.$variationId;
            $quantity = 'quantity'.$variationId;
            if($request->is_default == $variationId){
                $is_default = $request->is_default == $variationId ? 1 : 0;
            } else {
                $is_default = 0;
            }
             
            $variations[$variationId]['variation_id'] = $request->$variant_id;
            $variations[$variationId]['image'] = $request->$image;
            $variations[$variationId]['sku'] = $request->$sku;
            $variations[$variationId]['price'] = $request->$price;
            $variations[$variationId]['sale_price'] = $request->$sale_price;
            $variations[$variationId]['quantity'] = $request->$quantity;
            $variations[$variationId]['is_default'] = $is_default;
        }
         
        foreach($variations as $variation){
            $inputVariation['id'] = $variation['variation_id'];
            $inputVariation['image'] = $variation['image'];
            $inputVariation['sku'] = $variation['sku'];
            $inputVariation['price'] = $variation['price'];
            $inputVariation['sale_price'] = $variation['sale_price'];
            $inputVariation['quantity'] = $inputStock['quantity'] = $variation['quantity'];
            $inputVariation['is_default'] = $variation['is_default'];
            Variation::where('product_id',$product)->where('id',$inputVariation['id'])->update($inputVariation);
            $inputStock['status'] = 1;
            //Stock::where('product_id',$product)->where('variation_id',$inputVariation['id'])->update($inputStock);
            $matchThese = ['variation_id'=>$inputVariation['id'],'product_id'=>$product];
            Stock::updateOrCreate($matchThese,$inputStock);
            $count++;
        }
        if(count($variations) == $count){
            Session::flash('success',$count.' Variations has been saved successfully.');
        } else {
            Session::flash('warning','Something is wrong when saving variations.');
        }
        return redirect()->route('admin.products.index');

    }

    // public function checkString($search,$value){
    //     if(preg_match("/{$search}/i", $value)) {
    //         return true;
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units = Unit::all();
        $categoryId = Category::pluck('parent_id');
        $categories = Category::whereNotIn('id',$categoryId)->get();
        $product = Product::findOrFail($id);
        $optionSize = Option::where('product_id',$id)->where('name','size')->first();
        $optionColor = Option::where('product_id',$id)->where('name','color')->first();
        $variations = Variation::where('product_id',$id)->get();
        return view('admin.products.edit',compact('product','categories','units','optionSize','optionColor','variations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string','max:100'],
            'code' => ['nullable','string','max:30'],
            'affiliate_link' => ['nullable','string'],
            'model' => ['nullable','string'],
            'price' => ['required',],
            'image' => ['required','string'],
            'front_side_image' => ['required','string'],
            'right_side_image' => ['required','string'],
            'left_side_image' => ['required','string'],
            'back_side_image' => ['required','string'],
            'unit_id' => ['required','integer'],
            'status' => ['required','integer'],
            'description' => ['required','string'],
            'discount_amount' => ['nullable','integer'],
            'discount_percentage' => ['nullable','integer'],           
        ]);

        if ($validator->fails()) {
            return $validator->validate()->withInput();
        } else {
            $product->name = $request->name;
            $product->code = $request->code;
            $product->model = $request->model;
            $product->slug = Str::slug($request->name."-".$request->model."-".$product->code);
            $product->affiliate_link = $request->affiliate_link;
            $product->price = $request->price;
            
            $product->image = $request->image;
            $product->left_side_image = $request->left_side_image;
            $product->back_side_image = $request->back_side_image;
            $product->front_side_image = $request->front_side_image;
            $product->right_side_image = $request->right_side_image;
            
            $product->has_option = $request->has_option;
            
            $product->quantity = $request->quantity;
            $product->unit_id = $request->unit_id;
            $product->status = $request->status;
            $product->description = $request->description;
                
            if(isset($request->discount_amount) && $request->discount_amount > 0) {
                $discountAmount = $product->discount_amount = $request->discount_amount;
                $salePrice = $request->price - $discountAmount;
                $product->sale_price = $salePrice;
            }elseif(isset($request->discount_percentage) && $request->discount_percentage > 0) {
                $discountPercent = $product->discount_percentage = $request->discount_percentage;
                $discountAmount = $product->price * ($discountPercent / 100);
                $salePrice = $request->price - $discountAmount;
                $product->sale_price = $salePrice;
            }else {
                $product->sale_price = $request->sale_price;
            }
       
            // $product->meta_title = $request->meta_title;
            // $product->meta_tags = empty($request->hidden_meta_tags) ? null : json_encode(explode(",",$request->hidden_meta_tags));
            // $product->meta_description = $request->meta_description;

            if($product->save()) {
                $product->categories()->sync($request->category);

                // $product->optionValues()->forceDelete();
                // $product->options()->forceDelete();
                // $product->variants()->forceDelete();

                Session::flash('success','Product has been saved successfully.');
            } else {
                Session::flash('warning','Something is wrong when saving product.');
            }
            return redirect()->route('admin.attributes.edit',$product->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        
        //$product->categories()->detach();
        //$optionIds = Option::where('product_id',$product)->pluck('id')->toArray();
        //$optionValues = OptionValue::whereIn('option_id',$optionIds)->get();
        //$options = Option::where('product_id',$product)->get();
        //if($optionValues->delete() && $options->delete()){
            //$variations = Variation::where('product_id',$product)->get();
            //if($variations->delete()){
                $product->delete();
            //}
        //}
        
        return redirect()->back()->with('success','Product has been deleted successfully!');
    }
}
