<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class dashCtrl extends Controller
{
    public function index()
    {
        // if(Session::exists('userid')){
            return view('index');
        // }else{
    	   // return redirect()->to('login');
        // }
    }
    
}
