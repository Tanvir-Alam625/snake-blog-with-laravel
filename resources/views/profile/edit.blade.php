@extends('layouts.app')
@section('content')
<div class="profile-page tx-13">
    <div class="row">
      <div class="col-12 grid-margin">
                      <div class="profile-header">
                          <div class="cover">
                              <div class="gray-shade"></div>
                              <figure height="250px">
                                  <img 
                                  @if (Auth::user()->cover_image != null)
                                      src="{{asset('uploads')}}/cover_image/{{Auth::user()->cover_image}}"
                                  @else
                                  src="https://via.placeholder.com/1148x272"
                                  @endif
                                  height="250px" style="object-fit:cover;" alt="profile cover">
                              </figure>
                              <div class="cover-body d-flex justify-content-between align-items-center">
                                  <div>
                                      <img class="profile-pic" 
                                      @if (Auth::user()->cover_image != null)
                                      src="{{asset('uploads')}}/profile_image/{{Auth::user()->profile_image}}"
                                      @else
                                      src="https://via.placeholder.com/100x100"
                                      @endif
                                      style="object-fit:cover;"
                                      height='100'
                                      width='100'
                                       alt="profile">
                                      <span class="profile-name">Amiah Burton</span>
                                  </div>
                                  <div class="d-none d-md-block">
                                      <button class="btn btn-primary btn-icon-text btn-edit-profile">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit btn-icon-prepend"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Edit profile
                                      </button>
                                  </div>
                              </div>
                          </div>
                          <div class="header-links">
                              {{-- <ul class="links d-flex align-items-center mt-3 mt-md-0">
                                  <li class="header-link-item d-flex align-items-center active">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-columns mr-1 icon-md"><path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18"></path></svg>
                                      <a class="pt-1px d-none d-md-block" href="#">Timeline</a>
                                  </li>
                                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-1 icon-md"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                      <a class="pt-1px d-none d-md-block" href="#">About</a>
                                  </li>
                                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users mr-1 icon-md"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                      <a class="pt-1px d-none d-md-block" href="#">Friends <span class="text-muted tx-12">3,765</span></a>
                                  </li>
                                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image mr-1 icon-md"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                      <a class="pt-1px d-none d-md-block" href="#">Photos</a>
                                  </li>
                                  <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video mr-1 icon-md"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                                      <a class="pt-1px d-none d-md-block" href="#">Videos</a>
                                  </li>
                              </ul> --}}
                          </div>
          </div>
      </div>
      <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                        <h6 class="card-title">User Information</h6>
                        <form class="forms-sample" enctype="multipart/form-data" action="{{route('profile.update',['id'=> Auth::user()->id])}}" method="POST">
                            @csrf
                            <div class="form-group row">
                               <div class="col-md-6">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" name="name" value="{{ Auth::user()->name }}" placeholder="name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"  placeholder="Email"  value="{{ Auth::user()->email }}" readonly>
                                
                               </div>
                            </div>
                            <div class="form-group row">
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" value="{{ Auth::user()->address }}" placeholder="address" name="address">
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Facebook Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" 
                                @if ( count(explode('.com/', Auth::user()->facebook)) > 1)
                                    value="{{  explode('.com/', Auth::user()->facebook)[1] }}"
                                @endif
                                placeholder="Facebook username" name="facebook">
                                @error('facebook')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                            </div>
                            <div class="form-group row">
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Instagram Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" 
                                @if ( count(explode('.com/', Auth::user()->instagram)) > 1)
                                    value="{{  explode('.com/', Auth::user()->instagram)[1] }}"
                                @endif
                                placeholder="instagram username" name="instagram">
                                @error('instagram')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Twitter Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" 
                                @if ( count(explode('.com/', Auth::user()->twitter)) > 1)
                                    value="{{  explode('.com/', Auth::user()->twitter)[1] }}"
                                @endif
                                 placeholder="twitter username" name="twitter">
                                 @error('twitter')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                            </div>
                            <div class="form-group row">
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Profile Image</label>
                                <input type="file" class="form-control" id="exampleInputEmail1"  name="profile_image">
                                @error('profile_image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                               <div class="col-md-6">
                                <label for="exampleInputEmail1">Cover Image</label>
                                <input type="file" class="form-control" name="cover_image">
                                @error('cover_image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                               </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bio</label>
                                <textarea name="bio" class="form-control">
                                    {{Auth::user()->bio}}
                                </textarea>
                                @error('bio')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Update Info</button>
                        </form>
                        <br><br><br><br>
                        <form class="forms-sample"  action="{{route('password.change',['id'=> Auth::user()->id])}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Current Password</label>
                                <input type="password" class="form-control" id="exampleInputUsername1" autocomplete="off" name="current_password">
                                @error('current_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <label for="exampleInputUsername1">New Password</label>
                                <input type="password" class="form-control" id="exampleInputUsername1" autocomplete="off" name="new_password">
                                @error('new_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <label for="exampleInputUsername1">Confirm Password</label>
                                <input type="password" class="form-control" id="exampleInputUsername1" autocomplete="off" name="confirm_password">
                                @error('confirm_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            @if (session('error'))
                                <p class="text-danger">{{ session('error') }}</p><br>
                            @endif
                            <button type="submit" class="btn btn-primary mr-2">Change Password</button>
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