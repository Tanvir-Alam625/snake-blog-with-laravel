<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('posts.index',[
            'posts'=> Post::paginate(7)->withQueryString(),
            'trashPosts'=> Post::onlyTrashed()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('posts.create',[
            'categories'=> Category::all(),
            'tags'=> Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ==========================
        // form data validation  
        // ==========================
        $request->validate([
            '*'=>'required',
            'post_thumbnail'=>'mimes:jpg,png',
            'post_slug'=>'unique:posts,post_slug',
        ]);
        // ==========================
        // create the slug text 
        // ==========================
        $convert_slug= '';
        if($request->post_slug){
            $convert_slug = Str::snake($request->post_slug,'-');
        }else{
            $convert_slug = Str::snake($request->post_title,'-');
        }
        // ==========================
        // save the post thumbnail 
        // ==========================
        $thumbnail_name = auth()->user()->id. '_' .time().'.'.$request->file('post_thumbnail')->getClientOriginalExtension();
        $img = Image::make($request->file('post_thumbnail'));
        $img->save(base_path('public/uploads/post_thumbnail/'.$thumbnail_name));
        // ====================================
        // text editor for post description 
        // ===================================
        $post_description = $request->post_description;
        libxml_use_internal_errors(true);
        $dom = new \DomDocument();
        $dom->loadHtml('<?xml encoding="utf-8" ?>' . $post_description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    // must include this to avoid font problem
        $images = $dom->getElementsByTagName('img');
        // is image tag availble ?
        if (count($images) > 0) {
            // if multiple img tags then loop 
            foreach ($images as  $img) {
                $src = $img->getAttribute('src');
                // if the img source is 'data-url'
                if (preg_match('/data:image/', $src)) {
                    // get the mimetype
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];
                    // Generating a random filename
                    $filename =Str::limit($request->post_slug, 5) . '_' . auth()->id() . '_' . time() . '_' . Carbon::now()->format('Y');
                    $filepath = "uploads/post_description/$filename.$mimetype";
                    $image = Image::make($src)
                        ->encode($mimetype, 100)
                        ->save(public_path($filepath), 80);
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                }
            }
        }
        // modified entity ready to store in database
        $post_description = $dom->saveHTML();

        // =================================
        // insert post data into post table 
        // ================================
        $id = Post::insertGetId([
            'post_title' => $request->post_title,
            'post_slug' => $convert_slug,
            'post_thumbnail' => $thumbnail_name,
            'writer_id' => auth()->id(),
            'post_category' => $request->post_category,
            'post_subcategory' => $request->post_subcategory,
            'post_description' => $post_description,
            'post_status' => $request->post_status,
            'post_kind' => $request->post_kind,
            'post_type' => $request->post_type,
            'created_at' => now(),
        ]);
        
        // =================================
        // tow table relation post and tag
        // ================================
        // return $request->post_tags;
        $post = new Post();
        foreach ($request->post_tags as $tag) {
            $post->find($id)->RelationWithTag()->attach($tag);
        }

        return back()->withSuccess('Your Post added Successfully!');
    }
    /**
     * getSubcategory  for ajax calling subcategory.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSubcategory(Request $request)
    {
        $subCategories = SubCategory::where('parent_id', $request->category_id)->get();
        $subCategoryOption = '';
        foreach ($subCategories as  $subCategory) {
            $subCategoryOption .= "<option value='$subCategory->id'>$subCategory->name</option>";
        }
        return $subCategoryOption;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
    // post restore method 
    public function restore($id)
    {
        Post::onlyTrashed()->find($id)->restore();
        return back();
    }
}
