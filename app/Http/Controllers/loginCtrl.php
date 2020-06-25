<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class loginCtrl extends Controller
{
    public function index()
    {
    	return view('login');
    }
    public function login(Request $request)
    {
    	$client = new \GuzzleHttp\Client();
    	$data = (object)[
    		'email' => $request->email,
    		'deviceToken' => 'dashboard',
    		'socialid' => 'dashboard',
    		'submitType' => 'FB',
    		'pwd' => $request->password
    	];
    	$url = 'https://api.paparazzme.blazingtrail.in/v1/authentication';
		$response = $client->post($url, [
			'headers' => ['Content-Type' => 'application/json'],
			'body' => json_encode($data)
		]);

		if($response->getStatusCode() == 200){
			$res = json_decode($response->getBody()->getContents());
			$result = $res->resdata;

            if (gettype($result) == 'object') {
    			Session::put('userid', $result->_id);
                Session::put('name', $result->fullname);
                Session::put('loginType', $result->loginType);
    			Session::put('token', $res->token);
    			return redirect()->to('/');
            }else{
                Session::put('userid', $result[0]->_id);
                Session::put('name', $result[0]->fullname);
                Session::put('loginType', $result[0]->loginType);
                Session::put('token', $res->token);
                return redirect()->to('/');
            }
		}else{
			Session::flash('error', 'Something wrong!');
			return redirect()->back();
		}
    }
    public function logout()
    {
        Session::flush();
        return redirect()->to('login');
    }
}
