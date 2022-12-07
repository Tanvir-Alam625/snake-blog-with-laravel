<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use App\Models\User;

class adminUserController extends Controller
{
    //
    public function create(){
        $users = User::where([['role','!=', 'subscriber'],['id','!=', auth()->id()]])->latest()->paginate(7)->withQueryString();
        return view('users.create', compact('users'));
    }
    public function info(){
        return view('profile.edit');
    }
    public function destroy( $id){
        User::find($id)->delete();
        return back()->withSuccess('User Deleted!');
    }
    public function update(Request $request, $id){
        // return $request;
        User::find($id)->update([
            'name'=> $request->name,
            'address'=> $request->address,
            'bio'=> $request->bio,
            'facebook'=> 'https://www.facebook.com/'. $request->facebook,
            'instagram'=> 'https://www.instagram.com/' . $request->instagram,
            'twitter'=>  'https://twitter.com/' . $request->twitter,
        ]);
        return back()->withSuccess('Your Info Updated Successfully!');
    }
    public function store(Request $request){
        $request->validate([
            '*'=> 'required',
            'email'=>'email',
            'password'=> Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(),
        ]);
        User::insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'role'=> $request->role,
            'email_verified_at'=> now(),
            'created_at'=> now(),
        ]);
        return back()->withSuccess('successfully user added');
    }
}
