{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}




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
              <div class="auth-form-wrapper px-4 py-5">
                <a href="#" class="noble-ui-logo d-block mb-2">Noble<span>UI</span></a>
                <h5 class="text-muted font-weight-normal mb-4">Create a free account.</h5>
                <form class="forms-sample" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                    <label for="exampleInputUsername1">Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputUsername1" autocomplete="Username" placeholder="Name">
                    @error('name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}" id="exampleInputEmail1" placeholder="Email">
                   @error('email')
                       <p class="text-danger">{{ $message}}</p>
                   @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password"  class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                    @error('password')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password_confirmation"  class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                    @error('password_confirmation')
                    <p class="text-danger">{{$message}}</p>        
                    @enderror
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-primary text-white mr-2 mb-2 mb-md-0" type="submit">Sign Up</button>
                    <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                      <i class="btn-icon-prepend" data-feather="twitter"></i>
                      Sign up with twitter
                    </button>
                  </div>
                  <a href="login" class="d-block mt-3 text-muted">Already a user? Sign in</a>
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