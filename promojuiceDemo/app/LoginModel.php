<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;

class LoginModel extends Model
{


    public static function checkUser($email,$pass){
        
        $hash1 = DB::table('users')->where('email', $email)->value('password');
        if(Hash::check($pass,$hash1)){
            return true;
        } else {
            return false;
        }
        

    }

}
