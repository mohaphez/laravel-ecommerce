<?php

namespace App\Http\Controllers\Vue;

use App\Http\Controllers\Controller;
use App\Newsletter;
use App\Order;
use App\Ticket;
use App\TicketMessage;
use App\User;
use App\Wishlist;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $googleCaptchaUrl;

    public function __construct()
    {
        $this->googleCaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret=" . env("GOOGLE_CAPTCHA_SECRET") . "&response=";
    }

    public function login(Request $request)
    {
        $response = json_decode(file_get_contents($this->googleCaptchaUrl . $request->verify . "&remoteip=" . $_SERVER['REMOTE_ADDR'], true));
        if ($response->success != true) {
            return response()->json(['message' => 'متاسفانه شما ربات شناخته شدید :)'], 422);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            Auth::login($user);
            $token = $user->createToken('markent')->accessToken;
            $user = Auth::user()->name . ' ' . Auth::user()->family;
            return response()->json(['token' => $token, 'user' => $user], 200);
        } else {
            return response()->json(['error' => 'نام کاربری یا رمزعبور صحیح نمی باشد'], 401);
        }
    }

    /**
     * User Register
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string',
            'family' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required|string|min:6',
            'verify' => 'required',
        ]);
        $response = json_decode(file_get_contents($this->googleCaptchaUrl . $request->verify . "&remoteip=" . $_SERVER['REMOTE_ADDR'], true));
        if ($response->success != true) {
            return response()->json(['message' => 'متاسفانه شما ربات شناخته شدید :)'], 422);
        }
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'family' => $request->family,
            'mobile' => $request->mobile,
            'verify' => 'required',
        ]);
        Auth::login($user);
        $token = $user->createToken('markent')->accessToken;
        $user = Auth::user()->name . ' ' . Auth::user()->family;
        return response()->json(['token' => $token, 'user' => $user], 200);
    }

    /**
     * User Detail
     */
    public function userDetail()
    {
        $user = User::where('id', Auth::user()->id)->select('name', 'family', 'email', 'mobile')->first();
        return response()->json(['user' => $user]);
    }

    /**
     * User Detail Store
     */
    public function userDetailStore(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'name' => 'required|string',
            'family' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        User::whereId($user->id)->update([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'family' => $request->family,
            'mobile' => $request->mobile,
        ]);

        return response()->json(['message' => 'اطلاعات شما با موفقیت ثبت شد!'], 200);
    }

/**
 * User Info Such as name order number tickets count and ......
 */

    public function UserInfo()
    {
        $id = Auth::user()->id;
        $user = [
            'name' => Auth::user()->name . ' ' . Auth::user()->family,
            'order' => Order::where('user_id', $id)->count(),
            'wishlist' => Wishlist::where('user_id', $id)->count(),
            'ticket' => Ticket::where('user_id', $id)->count(),
            'unreadTicket' => TicketMessage::where('user_id', Auth::user()->id)->where('sender', 1)->where('read', 0)->count(),
        ];
        return response()->json(['user' => $user], 200);
    }

    /**
     * Return User Order List
     */
    public function OrderList()
    {
        $order = Order::where('user_id', Auth::user()->id)->select('code', 'price', 'status', 'created_at', 'id', 'pay_status', 'pay_method')->get();
        $orders = Order::orderList($order);
        return response()->json(['orders' => $orders], 200);
    }
    /**
     * user newsletter register
     */
    public function newsletter(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        $newsletter = Newsletter::where('email', $request->email)->first();
        if ($newsletter) {
            $newsletter->delete();
            return response()->json(["message" => "ایمیل شما از خبر نامه حذف شد !"], 200);
        } else {
            $newsletter = new Newsletter();
            $newsletter->email = $request->email;
            $newsletter->save();
            return response()->json(["message" => "شما با موفقیت در خبرنامه عضو شدید "], 200);
        }
    }
}
