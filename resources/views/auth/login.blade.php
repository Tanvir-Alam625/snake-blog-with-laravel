
@extends('layouts.guest1')
@section('content')

<div class="main-wrapper">
  <div class="page-wrapper full-page">
    <div class="page-content d-flex align-items-center justify-content-center">
      
      <div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
              <div class="row">
                <div class="col-md-4 pr-md-0">
                  <div class="auth-left-wrapper">
                  </div>
                </div>
                <div class="col-md-8 pl-md-0">
                  @if (session('status'))
                      <h2>{{ session('status')}}</h2>
                  @endif
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo d-block mb-2">Noble<span>UI</span></a>
                    <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
                    <form class="forms-sample" method="POST" action="{{ route('login') }}">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email')}}" id="exampleInputEmail1" placeholder="Email">
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                      </div>

                      @if (Route::has('password.request'))
                          <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                              {{ __('Forgot your password?') }}
                          </a>
                      @endif
                      <div class="block mt-4">
                          <label for="remember_me" class="inline-flex items-center">
                              <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                              <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                          </label>
                      </div>
                      <div class="mt-3">
                        <button class="btn btn-primary mr-2 mb-2 mb-md-0 text-white" type="submit">Login</button>
                        <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                          <i class="btn-icon-prepend" data-feather="twitter"></i>
                          Login with twitter
                        </button>
                      </div>
                      <a href="register" class="d-block mt-3 text-muted">Not a user? Sign up</a>
                    </form>
                  </div>
                </div>
              </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
  @endsection
  