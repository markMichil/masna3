<?php


namespace App\Http\Controllers;


class adminController extends Controller
{
 public function index(){
     $data = array();

     return view('backend.layouts.index')
         ->with('data',$data);
 }
}
