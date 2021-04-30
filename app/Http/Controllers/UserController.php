<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;

class UserController extends Controller
{

    public function dashboard() {
    	return view('user.account.dashboard');
    }

    public function editProfile(){
    	$user=auth()->user();
    	$data['user']=$user;
    	return view('user.account.edit-account',$data);
    }

    public function updateProfile(Request $request){
    	$request->validate([
        'firstname'=>'required|min:2|max:100',
        'lastname'=>'required|min:2|max:100',
        'email' => 'required|email|max:255|unique:users,email,'.Auth::user()->id.',id' 
        ]);

        $user = Auth::user();
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->email = $request['email'];
        $user->save();

        return redirect()->route('user.edit-profile')->with('success','Profile successfully updated');
    }

    public function changePassword(){ 
        return view('user.account.change-password');
    }


    public function updatePassword(Request $request){
        $request->validate([
        'current_password'=>'required|min:6|max:100',
        'new_password'=>'required|min:6|max:100|confirmed',
        ]);

        if(!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return back()->with('errors', 'Your current password does not match with what you provided');
        }

        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            return back()->with('error', 'Your current password cannot be same with the new password!');
          }

        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return back()->with('success', 'Password changed successfully!');
    }
}