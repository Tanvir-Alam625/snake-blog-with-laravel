@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    <h6 class="card-title">Create Admin and Writer</h6>
                    <form class="forms-sample" action="{{ route('user.create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Name">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password"  placeholder="Password">
                            @error('password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Role</label>
                            <select name="role" id="exampleInputPassword1" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="writer" selected >Writer</option>
                            </select>

                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
            </div>
          </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <h6 class="card-title">Admin & Writer List</h6>
            <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <th>{{$users->firstItem() + $loop->index}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->role === 'admin')
                                        <span class="badge badge-success">{{$user->role}}</span>
                                        @else
                                        <span class="badge badge-warning">{{$user->role}}</span>
                                    @endif
                                </td>
                                <td><button value="{{ route('user.destroy',['id'=>$user->id])}}" class="btn delete btn-danger">Delete</button></td>
                            </tr>
                            @empty
                                <tr>
                                    <td>
                                        <h2>No Data Found</h2>
                                    </td>
                                </tr>
                            @endforelse
                           
                        </tbody>
                    </table>
                        {{$users->render()}}
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
<script>
    $(document).ready(function(){
        $('.delete').click(function(){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.assign($(this).val());
            }
            })
        })
    })
</script>
@endsection