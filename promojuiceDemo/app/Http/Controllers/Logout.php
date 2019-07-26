<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

class Logout extends Controller
{
    public function index(Request $request){

        $token = $request->cookie('j0');
        $request->headers->set('Authorization', 'Bearer '.$token);
        JWTAuth::invalidate(JWTAuth::getToken());
    }
}
