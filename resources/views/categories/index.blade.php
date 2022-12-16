@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6> All categories items</h6>
    {{-- modal button  --}}
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Trash
        <span class="badge badge-light">{{count($trashCategories)}}</span>
    </button>
  <!-- start  Modal -->
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
                            {{-- <a href=" {{ route('categories.edit',['category'=>$category->id])}}" class="btn btn-warning">Resotre</a> --}}
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
    {{-- end modal  --}}
    </div>
<div class="row">
    {{-- Category table  --}}
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
    {{-- subCategory Table  --}}
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
@endsection