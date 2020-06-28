<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Response;

class bookingCtrl extends Controller
{
    public function index()
    {
    	$client = new \GuzzleHttp\Client();
    	if(Session::exists('userid')){
    		$token = Session::get('token');
    		$id = Session::get('userid');
    		if(Session::get('loginType') == 'user'){
		    	$url = 'https://api.paparazzme.blazingtrail.in/v1/booking/toUser?userid='.$id;
				$response = $client->get($url, [
					'headers' => ['auth' => $token]
				]);
				if($response->getStatusCode() == 200){
					$res = json_decode($response->getBody()->getContents());
					$data['bookings'] = $res;
					return view('booking', $data);
				}
			}else if(Session::get('loginType') == 'photographer'){
		    	$url = 'https://api.paparazzme.blazingtrail.in/v1/booking/toPgrapher?id='.$id;
				$response = $client->get($url, [
					'headers' => ['auth' => $token]
				]);
				if($response->getStatusCode() == 200){
					$res = json_decode($response->getBody()->getContents());
					$data['bookings'] = $res;
					return view('booking', $data);
				}
			}else{
				$url = 'https://api.paparazzme.blazingtrail.in/v1/admin/getAllBooking';
				$response = $client->get($url, [
					'headers' => ['auth' => $token]
				]);
				if($response->getStatusCode() == 200){
					$res = json_decode($response->getBody()->getContents());
					$data['bookings'] = $res;
					return view('booking', $data);
				}
			}
		}else{
			return redirect()->to('login');
		}
	}
	
	//single booking
	public function singleBooking($id)
	{
		$client = new \GuzzleHttp\Client();
		$token = Session::get('token');
		$url = 'https://api.paparazzme.blazingtrail.in/v1/admin/getOneBooking/?id='.$id;
		$response = $client->get($url, [
			'headers' => ['auth' => $token]
		]);
		if($response->getStatusCode() == 200){
			$res = json_decode($response->getBody()->getContents());
			$data['photographers'] = $res;
			return view('singlebooking', $data);
		}
	}
}
