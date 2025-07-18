<?php

namespace App\Http\Controllers\site\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\LoginVerifyRequest;
use App\Models\SiteUser;
use App\Util\messageUtil\messageUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        return view('site.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = SiteUser::query()
            ->where('email', $request->email)
            ->whereNotNull('email_verified_at')
            ->first();

        if (!$user) {
            to_route('login')->with('error', messageUtil::email_not_found);
        }

        $code = rand(10000, 99999);
        $expire = time() + 600;

        SiteUser::query()
            ->where('id', $user->id)
            ->update([
                'email_verified_code' => $code,
                'email_verified_code_expire' => $expire,
            ]);

        $text = "Email code: <b>$code</b> Code will expire after 10 minute.";
        Mail::send('mail.standard',compact('text'),function($message) use($request) {
            $message->to($request->email)->subject('Email Verification');
        });

        return to_route('login.verify',$user->id);
    }

    public function verifyIndex($user_id)
    {
        return view('site.auth.login-confirm', compact('user_id'));
    }

    public function verifySubmit($user_id, LoginVerifyRequest $request)
    {
        $user = SiteUser::query()
            ->where('id', $user_id)
            ->whereNotNull('email_verified_at')
            ->first();

        if (!$user) {
            to_route('login')->with('error', messageUtil::email_not_found);
        }

        if($user->email_verified_code != $request->code)
        {
            return to_route('login.verify',$user->id)->with('error','Wrong code');
        }

        elseif(time() > $user->email_verified_code_expire)
        {
            return to_route('login.verify',$user->id)->with('error','Code was expired');
        }

        SiteUser::query()
            ->where('id',$user_id)
            ->update([
                'email_verified_code_expire' => null,
                'email_verified_code' => null,
            ]);

        Auth::guard('main')
            ->loginUsingId($user_id);

        return to_route('index');
    }

    public function logout()
    {
        auth()->guard('main')->logout();
        return to_route('index');
    }

}
