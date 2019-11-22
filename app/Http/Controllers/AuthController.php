<?php

namespace App\Http\Controllers;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function register(Request $request){
        $request->validate([
           'email'=>'required',
           'name'=>'required',
           'password'=>'required'
       ]);
       $user = User::firstOrNew(['email'=>$request->email]);
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = bcrypt($request->password);
       $user->save();

       $http = new Client;

       $response = $http->post('http://127.0.0.1:8001/oauth/token', [
    'form_params' => [
        'grant_type' => 'password',
        'client_id' => '2',
        'client_secret' => 'iXaORrm8rCuiAE3ZOPKg1rn21GMbF08CHeHG204o',
        'username' => $request->email,
        'password' => $request->password,
        'scope' => '',
    ],
]);

return response (['data' => json_decode((string) $response->getBody(), true)]);
   }
public function login(Request $request){
    $request->validate([
        'email'=>'required',
        'password'=>'required'
    ]);
    $user = User::where('email',$request->email)->first();
    if(!$user){
        return response(['status'=>'error','message'=>'user not found']);
    }
    if(Hash::check($request->password,$user->password)){
        $http = new Client;
        $response = $http->post('http://127.0.0.1:8001/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'iXaORrm8rCuiAE3ZOPKg1rn21GMbF08CHeHG204o',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);
        
        return response (['data' => json_decode((string) $response->getBody(), true)]);
    }
}

}
