<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Response;

class adminCtrl extends Controller
{
    public function index()
    {
        if(Session::exists('userid') && Session::get('loginType') == 'admin'){
        	$client = new \GuzzleHttp\Client();
        	$token = Session::get('token');
        	$url = 'https://api.paparazzme.blazingtrail.in/v1/admin/getAll/?loginType=admin';
				$response = $client->get($url, [
					'headers' => ['auth' => $token]
				]);
				if($response->getStatusCode() == 200){
					$res = json_decode($response->getBody()->getContents());
					$data['users'] = $res;
					return view('admin_list', $data);
				}
        }else{
    	   return redirect()->to('login');
        }
    }
    public function create(Request $request)
    {
    	$token = Session::get('token');
    	$client = new \GuzzleHttp\Client();
    	$crtUrl = 'https://api.paparazzme.blazingtrail.in/v1/authorization';
    	$updateurl = 'https://api.paparazzme.blazingtrail.in/v1/update?id='.$request->id;

    	$data = (object)[
    		'from' => 'admin',
    		'loginType' => 'admin',
    		'submitType' => 'Form',
    		'deviceToken'=> 'admin_from_dashbord',
    		'socialid' => 'unknown',
    		'fullname' => $request->fullname,
    		'email' => $request->email,
    		'mobileNO' => $request->phone,
    		'pwd' => $request->password,
    		'billingAddress' => $request->address
    	];

    	if($request->id == ""){
	    	$response = $client->post($crtUrl, [
				'headers' => ['Content-Type' => 'application/json'],
				'body' => json_encode($data)
			]);
	    }else{
	    	$response = $client->put($updateurl, [
				'headers' => ['Content-Type' => 'application/json', 'auth' => $token],
				'body' => json_encode($data)
			]);
	    }
		if($response->getStatusCode() == 200){
			$res = json_decode($response->getBody()->getContents());
			return Response::json($res);
		}else{
			$res = (object)['status' => 'error'];
			return Response::json($res);
		}
    }
    public function single($id)
    {
    	$token = Session::get('token');
    	$client = new \GuzzleHttp\Client();
    	$url = 'https://api.paparazzme.blazingtrail.in/v1/getOne?id='.$id;
		$response = $client->get($url, [
			'headers' => ['auth' => $token]
		]);
		if($response->getStatusCode() == 200){
			$res = json_decode($response->getBody()->getContents());
			return Response::json($res);
		}
    }
    public function status($id)
    {
    	$token = Session::get('token');
    	$client = new \GuzzleHttp\Client();
    	$url = 'https://api.paparazzme.blazingtrail.in/v1/admin/change-status?id='.$id;
		$response = $client->get($url, [
			'headers' => ['auth' => $token]
		]);
		if($response->getStatusCode() == 200){
			$res = json_decode($response->getBody()->getContents());
			return Response::json($res);
		}
    }
    public function delete($id)
    {
    	$token = Session::get('token');
    	$client = new \GuzzleHttp\Client();
    	$url = 'https://api.paparazzme.blazingtrail.in/v1/delete?id='.$id;
		$response = $client->delete($url, [
			'headers' => ['auth' => $token]
		]);
		if($response->getStatusCode() == 200){
			$res = json_decode($response->getBody()->getContents());
			return Response::json($res);
		}
    }
    
}
