@extends('layouts.app')
@section('content')
<div class="profile-page tx-13">
    <div class="page-content">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Categories</h6>
                        <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{ $category->name}}</td>
                                            <td>{{ $category->slug}}</td>
                                            <td>
                                            <a href=" {{ route('categories.edit',['category'=>$category->id])}}" class="btn btn-warning">Edit</a>
                                            <form class="d-inline" action="{{ route('categories.destroy',['category'=>$category->id])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button  class="btn btn-danger btn-sm">Delete</button>
                                            </form>   
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                No Data Found
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Sub Categories</h6>
                        <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($subCategories as $subCategory)
                                        <tr>
                                            <th>{{$subCategories->firstItem() + $loop->index}}</th>
                                            <td>{{ $subCategory->name }}</td>
                                            <td>{{ $subCategory->slug }}</td>
                                            <td>
                                                <a href="" class="btn btn-danger">Delete</a>
                                                <a href="" class="btn btn-warning">Edit</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            No Data Found
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{$subCategories->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div/>
@endsection