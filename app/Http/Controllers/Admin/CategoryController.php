<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use PDF;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all(); 
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id','0')->orderBy('order_no')->get();
        return view('admin.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'parent_id' => ['nullable'],
            'name' => ['required', 'string', 'max:100','unique:categories,name'],
            'order_no' => ['nullable','integer','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/','min:0'],
            'banner' => ['required','string'],//'dimensions:min_width=700,min_height=215'
            'image' => ['required','string'],// 'dimensions:min_width=250,min_height=250'
            'icon' => ['nullable','string'],// 'max:20''dimensions:min_width=40,min_height=40'
        ]);

        if ($validator->fails()) {
            return $validator->validate()->withInput();
        } else {
 
            $category->parent_id = isset($request->parent_id) ? $request->parent_id : 0;
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->order_no = isset($request->order_no) ? $request->order_no : 0;
            //$category->tags = json_encode(explode(",",$request->hidden_tags));

            if ($request->has('banner')) {

                $banner = $request->file( 'banner' );  
                $bannerType = $banner->getClientOriginalExtension();
                $bannerStr = (string) Image::make( $banner )->
                                        resize( 700, 215, function ( $constraint ) {
                                            $constraint->aspectRatio();
                                        })->encode( $bannerType );

                $category->banner = base64_encode( $bannerStr );
                $category->banner_type = $bannerType;
            }
            
            if ($request->has('image')) {

                $image = $request->file( 'image' );  
                $imageType = $image->getClientOriginalExtension();
                $imageStr = (string) Image::make( $image )->
                                        resize( 250, 250, function ( $constraint ) {
                                            $constraint->aspectRatio();
                                        })->encode( $imageType );

                $category->image = base64_encode( $imageStr );
                $category->image_type = $imageType;
            }
            
            if ($request->has('icon')) {
                $icon = $request->file( 'icon' );  
                $iconType = $icon->getClientOriginalExtension();
                $iconStr = (string) Image::make( $icon )->
                                        resize( 40, 40, function ( $constraint ) {
                                            $constraint->aspectRatio();
                                        })->encode( $iconType );

                $category->icon = base64_encode( $iconStr );
                $category->icon_type = $iconType;
            }             
            
            $category->status = $request->status;
            
            if($category->save()) {
                Session::flash('message','Category created successfully.');
            } else {
                Session::flash('warning','Something is wrong when creating app info.');
            }

            return redirect()->route('admin.categories.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function pdf()
    {
        $categories = Category::with('subcategory')->get();
        $pdf = PDF::loadView('category.pdf',compact('categories'));
        $pdf->SetProtection(['print'], '', 'grocers');
        return $pdf->stream(''."Category".'.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::where('parent_id','0')->orderBy('order_no')->get();
        return view('category.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'parent_id' => ['nullable'],
            'name' => ['required', 'string', 'max:100'],
            'name_bn' => ['required','string','max:100'],
            'order_no' => ['nullable','integer','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/','min:0'],
            'hidden_tags' => ['nullable'],
            'banner' => ['nullable','image', 'max:1024', 'dimensions:min_width=700,min_height=215'],
            'image' => ['nullable','image', 'max:512', 'dimensions:min_width=250,min_height=250'],
            'icon' => ['nullable','image', 'mimes:png', 'max:20', 'dimensions:min_width=40,min_height=40'],
        ]);

        if ($validator->fails()) {
            return $validator->validate()->withInput();
        } else {
 
            $category->parent_id = isset($request->parent_id) ? $request->parent_id : 0;
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->name_bn = $request->name_bn;
            $category->order_no = isset($request->order_no) ? $request->order_no : 0;
            $category->tags = json_encode(explode(",",$request->hidden_tags));

            if ($request->has('pre_tags') && isset($request->pre_tags) && $request->has('hidden_tags') && isset($request->hidden_tags)) { 
                $category->tags = json_encode(explode(",",$request->pre_tags.','.$request->hidden_tags));
            } elseif ($request->has('hidden_tags') && isset($request->hidden_tags)) {
                $category->tags = json_encode(explode(",",$request->hidden_tags));
            } elseif ($request->has('pre_tags') && isset($request->pre_tags)) {
                $category->tags = json_encode(explode(",",$request->pre_tags));
            } else {
                $category->tags = $category->tags;
            }

            if ($request->has('banner')) {

                $banner = $request->file( 'banner' );  
                $bannerType = $banner->getClientOriginalExtension();
                $bannerStr = (string) Image::make( $banner )->
                                        resize( 700, 215, function ( $constraint ) {
                                            $constraint->aspectRatio();
                                        })->encode( $bannerType );

                $category->banner = base64_encode( $bannerStr );
                $category->banner_type = $bannerType;
            }
            
            if ($request->has('image')) {

                $image = $request->file( 'image' );  
                $imageType = $image->getClientOriginalExtension();
                $imageStr = (string) Image::make( $image )->
                                        resize( 250, 250, function ( $constraint ) {
                                            $constraint->aspectRatio();
                                        })->encode( $imageType );

                $category->image = base64_encode( $imageStr );
                $category->image_type = $imageType;
            }
            
            if ($request->has('icon')) {
                $icon = $request->file( 'icon' );  
                $iconType = $icon->getClientOriginalExtension();
                $iconStr = (string) Image::make( $icon )->
                                        resize( 40, 40, function ( $constraint ) {
                                            $constraint->aspectRatio();
                                        })->encode( $iconType );

                $category->icon = base64_encode( $iconStr );
                $category->icon_type = $iconType;
            }             
            
            $category->status = $request->status;
            
            if($category->save()) {
                Session::flash('message','Category updated successfully.');
            } else {
                Session::flash('warning','Something is wrong when creating app info.');
            }

            return redirect()->route('categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $category->subcategory()->delete();
    }
}
