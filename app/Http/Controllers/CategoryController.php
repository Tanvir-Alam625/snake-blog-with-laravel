<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
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
        $categoriesCount = count(Category::all());
        return view('categories.index',[
            'categories'=>Category::latest()->get(),
            'subCategories'=>SubCategory::latest()->paginate($categoriesCount)->withQueryString(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $categories= Category::all();
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
        // validation 
        $request->validate([
            'name'=> 'required',
            'image'=> 'required | mimes:jpg,png'
        ]);
        // create the slug text 
        $convert_slug= '';
        if($request->slug){
            $convert_slug = Str::snake($request->slug,'-');
        }else{
            $convert_slug = Str::snake($request->name,'-');
        }
        //  conditional insert data into database 
        if($request->parent_id > 0){
            // subcategory 
            $file_name = auth()->user()->id. '_' .time().'.'.$request->file('image')->getClientOriginalExtension();
                $img = Image::make($request->file('image'));
                $img->save(base_path('public/uploads/category_image/subcategory_image/'.$file_name));
                subCategory::insert([
                    'name'=>$request->name,
                    'parent_id'=>$request->parent_id,
                    'image'=> $file_name,
                    'status'=>$request->status,
                    'slug'=> $convert_slug,
                    'created_at'=>now()
                ]);
            return back()->withSuccess('SubCategory Created Successfully');
        }else{
            // category 
                $file_name = auth()->user()->id. '_' .time().'.'.$request->file('image')->getClientOriginalExtension();
                $img = Image::make($request->file('image'));
                $img->save(base_path('public/uploads/category_image/'.$file_name));
                Category::insert([
                    'name'=>$request->name,
                    'image'=> $file_name,
                    'status'=>$request->status,
                    'slug'=> $convert_slug,
                    'created_at'=>now()
                ]);
            return back()->withSuccess('Category Created Successfully');
        }
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
        return $category;
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
        $id = $category->id;
        $subCategories = SubCategory::where('parent_id',$id)->get();
        foreach ($subCategories as $subcategory) {
           $subcategory->delete();
        }
        $category->delete();
        return back();
    }
    
    public function trashDelete(Request $id)
    {
        return $id;
        // $id = $category->id;
        // $subCategory = SubCategory::where('parent_id',$id)->delete();
        // return back();
        // echo $subCategory;
        // return $subCategory;
    }

}
