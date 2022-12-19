@extends('layouts.app')
@section('content')
<div class="profile-page tx-13">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        
            <div class="card">
                <div class="card-body">
                        <h6 class="card-title">Create a new Category</h6>
                        <form class="forms-sample" enctype="multipart/form-data" action="{{route('categories.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group row">
                               <div class="col-md-6">
                                <label for="exampleInputUsername1">Category Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" name="name"  placeholder="name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Category Slug</label>
                                <input type="text" class="form-control" name="slug"  placeholder="slug" >
                                @error('slug')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                            </div>
                            <div class="form-group row">
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Category Image</label>
                                <input type="file" class="form-control"  name="image">
                                @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Parent Category</label>
                                
                                <select name="parent_id" id="">
                                    <option value="0">select Parent Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->name}}</option>
                                    @endforeach
                                </select>
                               </div>
                            </div>
                            <div class="form-group row">
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Category Status</label>
                                <select name="status" id="">
                                    <option value="active">active</option>
                                    <option value="inactive">inactive</option>
                                </select>
                               </div>
                            </div>
                            <br><br>
                            <button type="submit" class="btn btn-primary mr-2">Create Category</button>
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