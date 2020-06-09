<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class photographerCtrl extends Controller
{
    public function index()
    {
    	$client = new \GuzzleHttp\Client();
		// $response = $client->request('GET', 'https://api.paparazzme.blazingtrail.in/v1/admin/getAll/?loginType=photographer', ['auth' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI1ZWRiNjFhNmNjZDk3MDM3NGYyYTYyYTkiLCJ1c2VybmFtZSI6InRlc3Q2IiwiaWF0IjoxNTkxNTI1MDY1LCJleHAiOjE1OTE1Mjg2NjV9.C-IX-6QItfqYQbwmGFXfL4vd8MnsKSmC4QeHgnJhAM8']);
		// echo '<pre>';
		// print_r($response);
		// die();
    	return view('photographer');
    }
}
