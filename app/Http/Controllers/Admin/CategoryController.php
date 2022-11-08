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
        $adminCategories = Category::all(); 
        return view('admin.category.index',compact('adminCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adminCategories = Category::where('parent_id','0')->orderBy('order_no')->get();
        return view('admin.category.create',compact('adminCategories'));
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
            'name' => ['required', 'string', 'unique:categories,name'],
            'order_no' => ['nullable','integer','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/','min:0'],
        ]);

        if ($validator->fails()) {
            return $validator->validate()->withInput();
        } else {
 
            $category->parent_id = isset($request->parent_id) ? $request->parent_id : 0;
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->order_no = isset($request->order_no) ? $request->order_no : 0;
            //$category->tags = json_encode(explode(",",$request->hidden_tags));

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
    public function edit($id)
    {
        $adminCategories = Category::where('parent_id','0')->orderBy('order_no')->get();
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category','adminCategories'));
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
            'name' => ['required', 'string'],
            'order_no' => ['nullable','integer','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/','min:0'],
        ]);

        if ($validator->fails()) {
            return $validator->validate()->withInput();
        } else {
 
            $category->parent_id = isset($request->parent_id) ? $request->parent_id : 0;
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->order_no = isset($request->order_no) ? $request->order_no : 0;
            //$category->tags = json_encode(explode(",",$request->hidden_tags));

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
