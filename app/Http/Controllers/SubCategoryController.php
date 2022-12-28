<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
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
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        return view('categories.edit',[
            'category'=>$subCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
         // validation 
         $request->validate([
            'name'=> 'required | unique:sub_categories,name,'. $subCategory->id,
            'slug'=> 'required | unique:sub_categories,slug,' . $subCategory->id,
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
            // category 
                $old_image = $subCategory->image;
                unlink(base_path('public/uploads/category_image/subcategory_image/'.$old_image));
                $file_name = auth()->user()->id. '_' .time().'.'.$request->file('image')->getClientOriginalExtension();
                $img = Image::make($request->file('image'));
                $img->save(base_path('public/uploads/category_image/subcategory_image/'.$file_name));
                $subCategory->update([
                    'name'=>$request->name,
                    'image'=> $file_name,
                    'status'=>$request->status,
                    'slug'=> $convert_slug,
                ]);
            return back()->withSuccess('Category Created Successfully');
        }else{
            SubCategory::where('id',$subCategory->id)->update([
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
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return back()->withSuccess('Sub Category deleted.');
    }
    public function delete($id)
    {
        $subCategory = SubCategory::onlyTrashed()->find($id);
        unlink(base_path('public/uploads/category_image/subcategory_image/'.$subCategory->image));
        $subCategory->forceDelete();
        return back()->withSuccess('Deleted Successfully.');
    }
    public function restore($id)
    {   

        $subCategory = SubCategory::onlyTrashed()->find($id)->parent_id;
        $category = Category::withTrashed()->find($subCategory)->deleted_at;
        if($category == null){
            SubCategory::onlyTrashed()->find($id)->restore();
            return back()->withSuccess('SubCategory Restored Successfully!');
        }else{
            return back()->with('SubCategory_error','Your Parent Category before restore!');
        }
        
    }
}
