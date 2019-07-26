<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoginModel;
use App\User;
use Lang;
use JWTAuth;

class LoginVerify extends Controller
{
    public function login(Request $req){

        $email = $req->input('email')!== null ? $req->input('email') : '';
        $password = $req->input('password') !== null ? $req->input('password') : '';
        $email_regex = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,4}))$/';

        if($email && $password && preg_match($email_regex,$email)){
            $credentials = request(['email', 'password']);
            if(LoginModel::checkUser($email,$password)){

                $token = JWTAuth::attempt($credentials);

                if (!$token ) {

                    return response()->json(['error' => Lang::get('passwords.unregistered')], 401);
                }
                
                return $this->respondWithToken($token);

            }
            else{

                return response()->json(['error' => Lang::get('passwords.user')], 401);
            }

        }
        else{
            
            return response()->json(['error' => Lang::get('passwords.wrongCredentials')], 400);
        }    
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ])->withCookie(cookie()->forever('j0', $token));
    }
}
