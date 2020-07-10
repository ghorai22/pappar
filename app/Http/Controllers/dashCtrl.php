<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class dashCtrl extends Controller
{
    public function index()
    {
        if(Session::exists('userid')){
        	if(Session::get('loginType') == 'admin'){
	        	$token = Session::get('token');
	        	$client = new \GuzzleHttp\Client();
	        	//Photographer Count
	    		$url = 'https://api.paparazzme.blazingtrail.in/v1/admin/getAll/?loginType=photographer';
				$response = $client->get($url, [
					'headers' => ['auth' => $token]
				]);
				if($response->getStatusCode() == 200){
					$res = json_decode($response->getBody()->getContents());
					$data['photographers'] = count($res);
				}
				//Subcriber Count
				$url = 'https://api.paparazzme.blazingtrail.in/v1/admin/getAll/?loginType=user';
				$response = $client->get($url, [
					'headers' => ['auth' => $token]
				]);
				if($response->getStatusCode() == 200){
					$res = json_decode($response->getBody()->getContents());
					$data['subscribers'] = count($res);
				}
				//Booking Count
				$url = 'https://api.paparazzme.blazingtrail.in/v1/admin/forIndex-page';
				$response = $client->get($url, [
					'headers' => ['auth' => $token]
				]);
				if($response->getStatusCode() == 200){
					$res = json_decode($response->getBody()->getContents());
					$data['booking'] = implode(",", $res);
				}

	            return view('index', $data);
	        }elseif (Session::get('loginType') == 'photographer') {
	        	return redirect()->to('photographer');
	        }else{
	        	return redirect()->to('subscribers');
	        }
        }else{
    	   return redirect()->to('login');
        }
    }
    
}
