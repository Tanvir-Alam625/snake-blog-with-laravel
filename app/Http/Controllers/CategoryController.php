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
            'trashCategories'=>Category::onlyTrashed()->latest()->get(),
            'subtrashCategories'=>SubCategory::onlyTrashed()->latest()->get(),
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
        // create the slug text 
        $convert_slug= '';
        if($request->slug){
            $convert_slug = Str::snake($request->slug,'-');
        }else{
            $convert_slug = Str::snake($request->name,'-');
        }
        //  conditional insert data into database 
        if($request->parent_id > 0){
            // validation 
            $request->validate([
                'name'=> 'required | unique:sub_categories,name',
                'slug'=> 'unique:sub_categories,slug',
                'image'=> 'required | mimes:jpg,png'
            ]);
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
            // validation 
            $request->validate([
                'name'=> 'required | unique:categories,name',
                'slug'=> 'unique:categories,slug',
                'image'=> 'required | mimes:jpg,png'
            ]);
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
        return view('categories.edit',[
            'category'=>$category,
        ]);
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
        // validation 
        $request->validate([
            'name'=> 'required | unique:categories,name,'.$category->id,
            'slug'=> 'required | unique:categories,slug,'.$category->id ,
            'image'=> 'mimes:jpg,png'
        ]);
         // create the slug text 

         $convert_slug= '';
         if($request->slug){
             $convert_slug = Str::snake($request->slug,'-');
         }else{
             $convert_slug = Str::snake($request->name,'-');
         }
        if($request->image){
            // category  image update 
                $old_image = $category->image;
                unlink(base_path('public/uploads/category_image/'.$old_image));
                $file_name = auth()->user()->id. '_' .time().'.'.$request->file('image')->getClientOriginalExtension();
                $img = Image::make($request->file('image'));
                $img->save(base_path('public/uploads/category_image/'.$file_name));
                $category->update([
                    'name'=>$request->name,
                    'image'=> $file_name,
                    'status'=>$request->status,
                    'slug'=> $convert_slug,
                ]);
            return back()->withSuccess('Category Created Successfully');
        }else{
            Category::where('id',$category->id)->update([
                'name'=>$request->name,
                'status'=>$request->status,
                'slug'=> $convert_slug,
            ]);
            return back()->withSuccess('Category Created Successfully!');
        }
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
    
    // frocedelete Category 
    public function delete($id)
    {   $category_image = Category::onlyTrashed()->where('id',$id)->get()[0]->image;
       
        $subCategories = SubCategory::onlyTrashed()->where('parent_id',$id)->get();
        foreach ($subCategories as $subcategory) {
            $image_name  = $subcategory->image;
            $subcategory->forceDelete();
            unlink(base_path('public/uploads/category_image/subcategory_image/'.$image_name));
         }
         Category::onlyTrashed()->find($id)->forceDelete();
         unlink(base_path('public/uploads/category_image/'.$category_image));
        return back()->withSuccess('Categories Successfully Deleted!');
        
    }
    // restore Category 
    public function restore($id)
    {   
        $category_image = Category::onlyTrashed()->where('id',$id)->restore();
        return back()->withSuccess('Category Restore Successfully!');
    }

}
