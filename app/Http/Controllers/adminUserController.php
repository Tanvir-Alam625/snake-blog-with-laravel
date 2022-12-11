<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
// use Intervention\Image\Facades\Image;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Illuminate\Support\Facades\Hash;                       


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
    
    public function passwordChange(Request $request, $id){
        // password validation 
        $request->validate([
            '*'=>'required | min:6',
            'new_password'=> ['different:current_password', 'same:confirm_password', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            'confirm_password'=>'same:new_password',
        ]);
        // check with db password 
        if (Hash::check($request->current_password, auth()->user()->password)) {
            // change the user password 
            User::find($id)->update([
                'password'=>Hash::make($request->new_password),
            ]);
            return back()->withSuccess('Your Password Changed Successfully!');
        }else{
            return back()->with('error','Incorrect your current Password!');
        }
    }
    public function update(Request $request, $id){
        // input field validation 
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'facebook'=>'required',
            'instagram'=>'required',
            'twitter'=>'required',
            'bio'=>'required',
            'profile_image'=> 'mimes:jpg',
            'cover_image'=> 'mimes:jpg',
        ]);
        // update info 
        User::find($id)->update([
            'name'=> $request->name,
            'address'=> $request->address,
            'bio'=> $request->bio,
            'facebook'=> 'https://www.facebook.com/'. $request->facebook,
            'instagram'=> 'https://www.instagram.com/' . $request->instagram,
            'twitter'=>  'https://twitter.com/' . $request->twitter,
        ]);
        // update profile image 
        if ($request->hasFile('profile_image')) {
            $file_name = auth()->user()->id.'.'.$request->file('profile_image')->getClientOriginalExtension();
            $img = Image::make($request->file('profile_image'));
            $img->save(base_path('public/uploads/profile_image/'.$file_name));
            User::find($id)->update([
                'profile_image'=> $file_name,
            ]);
        }
        // update cover image 
        if ($request->hasFile('cover_image')) {
            $file_name = auth()->user()->id.'.'.$request->file('cover_image')->getClientOriginalExtension();
            $img = Image::make($request->file('cover_image'));
            $img->save(base_path('public/uploads/cover_image/'.$file_name));
            User::find($id)->update([
                'cover_image'=> $file_name,
            ]);
        }
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
