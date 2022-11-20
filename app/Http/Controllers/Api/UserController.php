<?php

namespace App\Http\Controllers\Api;

use App\Code;
use App\Http\Controllers\Controller;
use App\Setting;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Smsir;

class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * get user  mobile  number and send  5 digits  number  for  Auth
     */
    public function mobile($mobile)
    {
        $digits = 5;
        $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        Code::create(['mobile' => $mobile, 'code' => $code]);
        $api = Setting::first()->tel_bot_api;
        $uri = "https://api.telegram.org/bot" . $api;
        $command = file_get_contents($uri . "/sendMessage?chat_id=00000000&text=" . $code);
        shell_exec("php -r $command");
        $massage = "کد تایید شما برای  ورود فروشگاه   " . $code . "  می باشد";
        $result = Smsir::send([$massage], [$mobile]);
        dd($result);
        return response()->json(['code' => "send Successfully"], 200);

    }
    /**
     * [login description => check code and mobile number and login user]
     * @param  Request $request [get $mobile and $code for register and login user]
     * @return [string]         [send massage for auth is true or false => $success  or $error]
     */
    public function login(Request $request)
    {
        $mobile = $request['mobile'];
        $code = $request['code'];
        if ($user = User::where('mobile', $mobile)->first()) {
            if (Code::where('mobile', $mobile)->where('code', $request['code'])->first()) {
                Auth::login($user);
                $success['token'] = $user->createToken('markent')->accessToken;
                $mobiles = Code::where('mobile', $mobile)->get();
                foreach ($mobiles as $mobile) {
                    $mobile->delete();
                }
                return response()->json(['success' => $success, 'user' => true], $this->successStatus);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } elseif (Code::where('mobile', $mobile)->where('code', $request['code'])->first()) {

            $user = User::create(['email' => $mobile . '@mobile.com', 'mobile' => $mobile, 'password' => bcrypt("password")]);
            Auth::login($user);
            $success['token'] = $user->createToken('markent')->accessToken;
            $mobiles = Code::where('mobile', $mobile)->get();
            foreach ($mobiles as $mobile) {
                $mobile->delete();
            }
            return response()->json(['success' => $success, 'user' => false], 200);

        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * return user  Details  for  app
     */
    public function userDetails()
    {
        $user = Auth::user();
        return response()->json(['user' => [$user->name, $user->family]], 200);
    }

    /**
     * logout user  from app
     */
    public function logoutApi()
    {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
        }
    }

/**
 * app version check
 */
    public function app_version()
    {
        $version = Setting::first();
        return response()->json(['version' => $version->app_version], 200);
    }
/**
 * check app status
 */
    public function app_status()
    {
        $status = Setting::first();
        if ($status->app_status) {
            return response()->json(['status' => 'true', 'message' => 'ok'], 200);
        } else {
            return response()->json(['status' => 'false', 'message' => $status->app_error], 200);
        }
    }
}
