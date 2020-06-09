<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admin extends Controller
{
    public function login(){
    	return view('backend.layouts.login');
    }
// ===============================================================================================

    public function login_post(){
$data=array();
		$remember_me = request()->has('remember') ? true: false;
		if(auth()->attempt(['email'=> request('username')  , 'password'=>request('password')],$remember_me)){
		return redirect('/home')->with($data);
		} else{
			// dd(request());
		return back();
		}
		}


// ===============================================================================================
public function index(){
	return view('backend.layouts.index');
}

}