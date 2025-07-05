<?php

namespace App\Http\Controllers\site\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\RegisterRequest;
use App\Models\SiteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index()
    {
        return view('site.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $check = SiteUser::query()
            ->where('email',$request->email)
            ->whereNotNull('email_verified_at')
            ->exists();

        if($check)
        {
            return to_route('register')->with('error','Email already registered');
        }

        $code = rand(10000, 99999);
        $expire = time() + 10 * 60;

        $user = SiteUser::query()
            ->create([
                'fullname' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'email_verified_code' => $code,
                'email_verified_code_expire' => $expire,
            ]);

        $text = "Hello $request->name. Welcome to our site. Your verification code is <b>$code</b> Code will expire after 10 minute.";
        Mail::send('mail.standard',compact('text'),function($message) use($request) {
            $message->to($request->email)->subject('Email Verification');
        });

        return to_route('register.verify',$user->id);
    }
    public function verifyIndex($user_id)
    {
        return view('site.auth.register-confirm',compact('user_id'));
    }

    public function verify($user_id,Request $request)
    {
        $user = SiteUser::query()
            ->Where('id',$user_id)
            ->WhereNull('email_verified_at')
            ->first();

        if(!$user)
        {
            return to_route('index')->with('error','User not found');
        }

        if($user->email_verified_code != $request->code)
        {
            return to_route('register.verify',$user->id)->with('error','Wrong code');
        }

        elseif(time() > $user->email_verified_code_expire)
            {
                return to_route('register.verify',$user->id)->with('error','Code was expired');
            }

        SiteUser::query()
            ->where('id',$user_id)
            ->update([
                'email_verified_at' => now(),
                'email_verified_code_expire' => null,
                'email_verified_code' => null,
            ]);

        SiteUser::query()
            ->where('email',$user->email)
            ->whereNull('email_verified_at')
            ->delete();

        return to_route('index')->with('success','User has been verified');
    }

    public function refreshCode($user_id)
    {
        $user = SiteUser::query()
            ->where('id',$user_id)
            ->whereNull('email_verified_at')
            ->first();

        if(!$user)
        {
            return to_route('index')->with('error','User not found');
        }

        $code = rand(10000, 99999);
        $expire = time() + 10 * 60;

        $user->update([
            'email_verified_code' => $code,
            'email_verified_code_expire' => $expire,
        ]);

        $text = "Your verification code is <b>$code</b> Code will expire after 10 minute.";
        Mail::send('mail.standard',compact('text'),function($message) use($user) {
            $message->to($user->email)->subject('Email Verification');
        });

        return to_route('register.verify',$user->id);
    }
}
