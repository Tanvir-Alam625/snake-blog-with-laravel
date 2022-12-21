@extends('layouts.app')
@section('content')
<div class="row">
    {{-- Category section   --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between justify-items-center mb-6 ">
                    <h2>Tags</h2>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Add Tag
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add A New Tag</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action="{{route('tag.store')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1">
                                            <i class="link-icon" height='15' data-feather="tag"></i>
                                          </span>
                                        </div>
                                        <input type="text" name="tag_name" class="form-control " placeholder="Tag Name" aria-label="Username" aria-describedby="basic-addon1">
                                      </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add Tag</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-7" style="flex-wrap: wrap">
                   @forelse ($tags as $tag)
                   <div class="m-2 p-2 rounded-lg bg-light d-flex" >
                        <h3 class="m-0 p-0">{{$tag->tag_name}}</h3>
                        <form action="{{route('tag.destroy', ['tag'=>$tag->id])}}" method="post">
                            @csrf
                            @method('DELETE')

                           <button type="submit" style="background: transparent; border:none; outline:none;">
                            <svg height="25" width="25" style="font-weight:bold; margin-left:10px; cursor:pointer; " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                           </button>
                        </form>
                    </div>
                   @empty
                        <h5 class="text-align-center" >No Data Found</h5>
                     
                   @endforelse
                  
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