<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests\LoginReq;

class loginCtrl extends Controller
{
    public function index()
    {
        if(Session::exists('userid'))
            return redirect()->back();
        else
    	    return view('login');
    }
    public function login(LoginReq $request)
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
                for ($i=0; $i < count($result); $i++) { 
                    if($request->email == $result[$i]->email){
                        Session::put('userid', $result[$i]->_id);
                        Session::put('name', $result[$i]->fullname);
                        Session::put('loginType', $result[$i]->loginType);
                        Session::put('token', $res->token);
                        return redirect()->to('/');
                    }
                }
            }
		}else{
			Session::flash('error', 'Something wrong!');
			return redirect()->to('login');
		}
    }
    public function logout()
    {
        Session::flush();
        return redirect()->to('login');
    }
    public function forgotPass()
    {
        return view('change');
    }
    public function changePass(Request $request)
    {
        $pass = $request->password;
        $cnfPass = $request->confirm_password;

        if($pass == $cnfPass){
            $client = new \GuzzleHttp\Client();
            $data = (object)[
                'email' => $request->email,
                'pwd' => $request->password
            ];
            $url = 'https://api.paparazzme.blazingtrail.in/v1/password-change';
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode($data)
            ]);

            if($response->getStatusCode() == 200){
                $res = json_decode($response->getBody()->getContents());
                if($res == '1'){
                    Session::flash('success', 'Password change successful.');
                    return redirect()->to('login');
                }else{
                    Session::flash('error', 'Something wrong, try again');
                    return redirect()->to('forgot-password');
                }
            }
        }else{
            Session::flash('error', 'Passwords do not match.');
            return redirect()->to('forgot-password');
        }
    }
}
