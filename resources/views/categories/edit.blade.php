@extends('layouts.app')
@section('content')
<div class="profile-page tx-13">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                        <h6 class="card-title">Update Your Category</h6>
                        <form class="forms-sample" enctype="multipart/form-data"
                        @if ($category->parent_id)
                        action="{{route('subCategories.update',['subCategory'=>$category->id])}}"
                        @else
                        action="{{route('categories.update',['category'=>$category->id])}}"
                        @endif
                        enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                               <div class="col-md-6">
                                <label for="exampleInputUsername1">Category Name</label>
                                <input type="number" hidden name="id" value="{{$category->id}}">
                                <input type="text" value="{{$category->name}}" class="form-control" id="exampleInputUsername1" autocomplete="off" name="name"  placeholder="name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Category Slug</label>
                                <input type="text" class="form-control" name="slug" value="{{ $category->slug}}"  placeholder="slug">
                                @error('slug')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                            </div>
                            <div class="form-group row">
                               <div class="col-md-6">
                                    <label for="exampleInputEmail1">Category Image</label>
                                    <input type="file" class="form-control"  name="image">
                               </div>
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Category Status</label>
                                <select name="status" id="">
                                    <option value="active" @selected($category->status == 'active')>active</option>
                                    <option value="inactive"  @selected($category->status == 'inactive')>inactive</option>
                                </select>
                           </div>
                            </div>
                            <br><br>
                            <button type="submit" class="btn btn-primary mr-2">Update Category</button>
                        </form>
                </div>
            </div>
        </div>  
</div>   
@endsection
@section('script')
@if (session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'success',
            title: '{{session('success')}}'
            })
    </script>
@endif
@endsection