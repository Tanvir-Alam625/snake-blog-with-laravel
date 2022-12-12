<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $categories= Category::where('parent_id',0)->get();
        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'image'=> 'required | mimes:jpg,png'
        ]);
        $convert_slug= '';
        if($request->slug){
            $convert_slug = Str::snake($request->slug,'-');
        }else{
            $convert_slug = Str::snake($request->name,'-');
        }
            $file_name = auth()->user()->id. '_' .time().'.'.$request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'));
            $img->save(base_path('public/uploads/category_image/'.$file_name));
            Category::insert([
                'name'=>$request->name,
                'image'=> $file_name,
                'status'=>$request->status,
                'slug'=> $convert_slug,
                'parent_id'=>$request->parent_id,
                'created_at'=>now()
            ]);
        return back()->withSuccess('Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
