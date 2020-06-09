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
    		'submitType' => 'Form',
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
			Session::put('userid', $result[0]->_id);
            Session::put('loginType', $result[0]->loginType);
			// Session::put('loginType', 'admin');
			Session::put('token', $res->token);
			return redirect()->to('/');
		}else{
			Session::flash('error', 'Something wrong!');
			return redirect()->back();;
		}
    }
}



// $amount = $request->get('amount');
// $client = new \GuzzleHttp\Client();
// $url   = "http://192.168.150.16:7585/api/v1/Transaction/GetTransactionNumber";
// $data   = [
//             "amount"      => $amount,
//             "something"   => "1",
//             "description" => "desc",
//           ];

// $requestAPI = $client->post( $url, [
//         'headers' => ['Content-Type' => 'application/json'],
//         'body' => json_encode($data);
//     ]);
