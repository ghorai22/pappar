<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Response;

class subscriberCtrl extends Controller
{
    public function index()
    {
    	$client = new \GuzzleHttp\Client();
    	if(Session::exists('userid')){
    		$token = Session::get('token');
    		if(Session::get('loginType') == 'user'){
		    	$id = Session::get('userid');
		    	$url = 'https://api.paparazzme.blazingtrail.in/v1/getOne?id='.$id;
				$response = $client->get($url, [
					'headers' => ['auth' => $token]
				]);
				if($response->getStatusCode() == 200){
					$res = json_decode($response->getBody()->getContents());
					$result[0] = $res;
					$data['subscribers'] = $result;
					return view('subscribers', $data);
				}
			}else{
				$url = 'https://api.paparazzme.blazingtrail.in/v1/admin/getAll/?loginType=user';
				$response = $client->get($url, [
					'headers' => ['auth' => $token]
				]);
				if($response->getStatusCode() == 200){
					$res = json_decode($response->getBody()->getContents());
					$data['subscribers'] = $res;
					return view('subscribers', $data);
				}
			}
		}else{
			return redirect()->to('login');
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
			if(gettype($res) == 'object'){
    			return Response::json($res);
            }else{
                return Response::json($res[0]);
            }
		}
    }
    public function update(Request $request)
    {
    	$token = Session::get('token');
    	$client = new \GuzzleHttp\Client();
    	$url = 'https://api.paparazzme.blazingtrail.in/v1/update?id='.$request->id;
    	if($request->dp == 'no-change'){
	    	$data = (object)[
	    		'fullname' => $request->fname,
	    		'email' => $request->email,
	    		'mobileNo' => $request->phone,
	    		'billingAddress' => $request->address
	    	];
	    }else{
	    	$data = (object)[
	    		'fullname' => $request->fname,
	    		'email' => $request->email,
	    		'mobileNo' => $request->phone,
	    		'billingAddress' => $request->address,
	    		'fullpath' => $request->dp
	    	];
	    }
		$response = $client->put($url, [
		  'json' => $data,
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
}
