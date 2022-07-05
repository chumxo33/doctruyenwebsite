<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite, Auth, Redirect, Session, URL;
use App\Models\User;

class SocialController extends Controller
{
    // sử dụng của nhà cung cấp
    public function redirectGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function processGoogleLogin(){
        // ktra đăng nhập google
        $googleUser = Socialite::driver('google')->user();
        if(!$googleUser){
            return redirect('/login');
        }

        $systemUser = User::FirstOrCreate(
            // ktra google_id - >chưa thì gộp vào db_user
            [ 'google_id'=>$googleUser->id ],
            [
                'name'=>$googleUser->name,
                'email'=>$googleUser->email,
            ]
        );
        // Nếu có thì đăng nhập
        Auth::loginUsingId($systemUser->id);
        return redirect('/home');
    }
}
