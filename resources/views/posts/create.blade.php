@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    <h6 class="card-title">Create a new Post</h6>
                    <form class="forms-sample" enctype="multipart/form-data" action="{{route('post.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group row">
                           <div class="col-md-6">
                            <label for="post_title">Post Title</label>
                            <input type="text" class="form-control" id="post_title" autocomplete="off" name="post_title">
                            @error('post_title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                           </div>
                           <div class="col-md-6">
                            <label for="post_slug">Post Slug</label>
                            <input type="text" class="form-control" name="post_slug"  >
                            @error('post_slug')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                           </div>
                        </div>                                
                        <div class="form-group row">
                           <div class="col-md-6">
                            <label for="post_tag">Category Image</label>
                            <input type="text" class="form-control"  name="post_tag" id="post_tag">
                            @error('post_tag')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                           </div>
                           <div class="col-md-6">
                            <label for="post_category">Select Category</label>
                            <select name="post_category" id="post_category">
                               <option >Select one Category</option>
                               @foreach ($categories as $category)
                               <option value="{{$category->id}}" >{{$category->name}}</option>
                               @endforeach
                            </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-6">
                            <label for="post_subcategory">Post Subcategory</label>
                            <select name="post_subcategory" id="post_subcategory">
                                <option value="0">Select one subCategory</option>
                            </select>
                           </div>
                           <div class="col-md-6">
                            <label for="post_status">Post Status</label>
                            <select name="post_status" id="post_status">
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                            </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-6">
                            <label for="post_type">Post Type</label>
                            <select name="post_type" id="post_type">
                                <option value="features">Features</option>
                                <option value="popular">Popular</option>
                            </select>
                           </div>
                           <div class="col-md-6">
                            <label for="post_kind">Post Kind</label>
                            <select name="post_kind" id="post_kind">
                                <option value="trending">Trending</option>
                                <option value="latest">latest</option>
                                <option value="older">older</option>
                            </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                            <label for="post_thumbnail">Post Thumbnail</label>
                            <input type="file" class="form-control" name="post_thumbnail"  >
                            @error('post_thumbnail')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                            <label for="post_thumbnail">Post Description</label>
                            <textarea name="post_description" id="summernote" cols="30" rows="10"></textarea>
                            @error('post_thumbnail')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                           </div>
                        </div>
                        <br><br>
                        <button type="submit" class="btn btn-primary mr-2">Create Post</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $("#summernote").summernote({
            placeholder: 'describe your post',
            height: 400,
        });
        $('.select_js').select2();
    });
</script>
    
@endsection

