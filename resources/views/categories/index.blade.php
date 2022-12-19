@extends('layouts.app')
@section('content')
<div class="row">
    {{-- Category section   --}}
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                    <div class="table-responsive">
                        {{-- categories trash modal container start  --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="card-title">Categories</h6>
                            {{-- Categories trash modal button  --}}
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Trash
                                <span class="badge badge-light">{{count($trashCategories)}}</span>
                            </button>
                            <!-- start  Categories Trash Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">All Trash Items</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Serial</th>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($trashCategories as $trashcategory)
                                                    <tr>
                                                        <th>{{$loop->iteration}}</th>
                                                        <td>{{ $trashcategory->name}}</td>
                                                        <td>
                                                        <a href=" {{ route('category.restore',['id'=>$trashcategory->id])}}" class="btn btn-warning">Resotre</a>
                                                        <form class="d-inline" action="{{ route('category.force', ['id'=>$trashcategory->id])}}" method="post">
                                                            @csrf
                                                            <button  class="btn btn-danger btn-sm">Delete</button>
                                                        </form>   
                                                        </td>
                                                    </tr>
                                                    @empty
                                                        <tr>
                                                            <th class="text-center" colspan="3">No Data Found</th>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end Categories Trash container Modal  --}}
                        {{--  Start Categories Table Tags  --}}
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{ $category->name}}</td>
                                        <td>
                                            @if ($category->status === 'active')
                                                <span class="badge badge-success badge-sm">Active</span>
                                                @else
                                                <span class="badge badge-warning badge-sm">Inactive</span>
                                            @endif
                                        </td>
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
                                            <th class="text-center" colspan="3">No Data Found</th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                    </div>
            </div>
        </div>
    </div>
    {{-- subCategory section  --}}
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                     {{-- subcategories trash modal container start  --}}
                     <div class="d-flex justify-content-between justify-item-center mb-4">
                        <h6 class="card-title">Sub Categories</h6>
                        {{-- Categories trash modal button  --}}
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal1">Trash
                            <span class="badge badge-light">{{count($subtrashCategories)}}</span>
                        </button>
                        <!-- start  subCategories Trash Modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">All Trash Items</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- trash table->subCategories  --}}
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Serial</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($subtrashCategories as $subtrashcategory)
                                                <tr>
                                                    <th>{{$loop->iteration}}</th>
                                                    <td>{{ $subtrashcategory->name}}</td>
                                                    <td>
                                                    <a href=" {{ route('subCategories.delete',['id'=>$subtrashcategory->id])}}" class="btn btn-danger">Delete</a>
                                                    <a href=" {{ route('subCategories.restore',['id'=>$subtrashcategory->id])}}" class="btn btn-success">Restore</a>
                                                    </form>   
                                                    </td>
                                                </tr>
                                                @empty
                                                    <tr>
                                                        <th class="text-center" colspan="3">No Data Found</th>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end subCategories Trash container Modal  --}}
                    {{-- start subcategories table  --}}
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Parent Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subCategories as $subCategory)
                                <tr>
                                    <th>{{$subCategories->firstItem() + $loop->index}}</th>
                                    <td>{{ $subCategory->name }}</td>
                                    <td>{{ $subCategory->RelationWithCategory->name }}</td>
                                    <td>
                                        @if ($subCategory->status === 'active')
                                            <span class="badge badge-success badge-sm">Active</span>
                                            @else
                                            <span class="badge badge-warning badge-sm">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $subCategory->slug }}</td>
                                    <td>
                                        <a href=" {{ route('subCategories.edit',['subCategory'=>$subCategory->id])}}" class="btn btn-warning">Edit</a>
                                        <form class="d-inline" action="{{route('subCategories.destroy', ['subCategory'=>$subCategory->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                        {{-- <a href="{{route('subCategories.destroy', ['subCategory'=>$subCategory->id])}}" >Delete</a> --}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th class="text-center" colspan="4">No Data Found</th>
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
@if (session('SubCategory_error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
            icon: 'error',
            title: '{{session('SubCategory_error')}}'
            })
    </script>
@endif
@endsection