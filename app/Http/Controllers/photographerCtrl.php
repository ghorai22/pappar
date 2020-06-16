<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Response;

class photographerCtrl extends Controller
{
    public function index()
    {
    	$client = new \GuzzleHttp\Client();
    	if(Session::exists('userid')){
    		$token = Session::get('token');
    		if(Session::get('loginType') == 'photographer'){
		    	$id = Session::get('userid');
		    	$url = 'https://api.paparazzme.blazingtrail.in/v1/getOne?id='.$id;
				$response = $client->get($url, [
					'headers' => ['auth' => $token]
				]);
				if($response->getStatusCode() == 200){
					$res = json_decode($response->getBody()->getContents());
					$result[0] = $res;
					$data['photographers'] = $result;
					return view('photographer', $data);
				}
			}else{
				$url = 'https://api.paparazzme.blazingtrail.in/v1/admin/getAll/?loginType=photographer';
				$response = $client->get($url, [
					'headers' => ['auth' => $token]
				]);
				if($response->getStatusCode() == 200){
					$res = json_decode($response->getBody()->getContents());
					$data['photographers'] = $res;
					return view('photographer', $data);
				}
			}
		}else{
			return redirect()->to('login');
		}
    }
    public function add()
    {
    	if(Session::exists('userid')){
    		return view('add_photographer');
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
			return Response::json($res);
		}
    }
    public function stepOne(Request $request)
    {
    	$token = Session::get('token');
    	$client = new \GuzzleHttp\Client();
    	$url = 'https://api.paparazzme.blazingtrail.in/v1/authorization';

    	$data = (object)[
    		'from' => 'admin',
    		'loginType' => 'photographer',
    		'submitType' => 'Form',
    		'deviceToken'=> 'admin_from_dashbord',
    		'socialid' => 'unknown',
    		'fullname' => $request->name,
    		'email' => $request->email,
    		'mobileNO' => $request->phone,
    		'billingAddress' => $request->address,
    		'pwd' => $request->phone,
    		'age' => $request->age,
    		'briefBio' => $request->bio,
    		'photo' => $request->dp
    	];
    	$response = $client->post($url, [
			'headers' => ['Content-Type' => 'application/json'],
			'body' => json_encode($data)
		]);
		if($response->getStatusCode() == 200){
			$res = json_decode($response->getBody()->getContents());
			return Response::json($res);
		}else{
			$res = (object)['status' => 'error'];
			return Response::json($res);
		}
    }
    public function stepTwo(Request $request)
    {
        $token = Session::get('token');
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.paparazzme.blazingtrail.in/v1/update?id='.$request->id;
        $data = (object)[
            'type' => $request->type,
            'expertise' => $request->expertise,
            'equipmentLevel' => $request->equipmentLevel,
            'amountOfService' => $request->amountOfService,
            'currencyOfService' => $request->currencyOfService,
            'languageSpoken' => $request->languageSpoken,
            'lightingOption' => $request->lightingOption,
            'greenScreens' => $request->greenScreens,
            'postShoot_retouching_editing' => $request->postShoot_retouching_editing,
            'virtualReality_shoot' => $request->virtualReality_shoot,
            'droneAerial_shoot' => $request->droneAerial_shoot,
            'animationCreation' => $request->animationCreation,
            'music' => $request->music,
            'voiceOver' => $request->voiceOver,
            'soundEffect' => $request->soundEffect,
            'specialEffects_filter' => $request->specialEffects_filter
        ];

        $response = $client->put($url, [
            'headers' => ['Content-Type' => 'application/json', 'auth' => $token],
            'body' => json_encode($data)
        ]);
        if($response->getStatusCode() == 200){
            $res = json_decode($response->getBody()->getContents());
            return Response::json($res);
        }
    }
    public function upload(Request $request)
    {
		$token = Session::get('token');
    	$time = date('ymdHis');
    	if($request->hasFile('dp'))
        {
            $img = $request->file('dp');

            $name = $time.".".$img->clientExtension();
            $path = public_path().'\upload\\';
            $img->move($path, $name);

            $client = new \GuzzleHttp\Client();
    		$url = 'https://api.paparazzme.blazingtrail.in/v1/admin/uploadPic/';

    		$response = $client->post($url, [
			    'headers' => ['auth' => $token],
			    'multipart' => [
			        [
			            'name'     => 'photo',
			            'contents' => file_get_contents($path . $name),
			            'filename' => $name
			        ]
			    ],
			]);
    		if($response->getStatusCode() == 200){
				$res = json_decode($response->getBody()->getContents());
				$data = (object)['status' => 'success', 'dp' => $res];
				return Response::json($data);
			}
        }
    }
    public function stepFour(Request $request)
    {
    	$token = Session::get('token');
        $images = $request->file('portfolio');
        $noRow = $request->row;
        $time = date('ymdHis');
        $img = $images[$noRow];
        $name = $time.$noRow.".".$img->clientExtension();
        $path = public_path().'\upload\\';
        $img->move($path, $name);

        $client = new \GuzzleHttp\Client();
        $url = 'https://api.paparazzme.blazingtrail.in/v1/admin/upload-multiple/';

        $response = $client->post($url, [
            'headers' => ['auth' => $token],
            'multipart' => [
                [
                    'name'     => 'upload_file',
                    'contents' => file_get_contents($path . $name),
                    'filename' => $name
                ],
                [
                    'name' => 'pgrapherid',
                    'contents' => $request->id
                ]
            ],
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
