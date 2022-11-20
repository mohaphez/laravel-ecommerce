<?php

namespace App\Http\Controllers\Admin;

use App\Checkout;
use App\Http\Controllers\Controller;
use App\Newsletter;
use App\Order;
use App\Role;
use App\Setting;
use App\User;
use Auth;
use DataTables;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        return view('Admin.user.user');
    }
    /**
     * [list description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    function list(Request $request) {
        if ($request->ajax()) {
            $users = User::select('id', 'name', 'family', 'email', 'mobile')->orderBy('created_at', 'DESC')->get();
            return Datatables::of($users)->addColumn('action', function ($user) {
                return '<a href="' . route('user.profile.show', ['id' => $user->id]) . '"><button type="button" class="btn btn-primary">نمایش</button></a>';
            })
                ->make(true);
        }
    }
    /**
     * [roleIndex description]
     * @return [type] [description]
     */
    public function roleIndex()
    {
        return view('Admin.user.role');
    }
    /**
     * [roleList description]
     * @return [type] [description]
     */
    public function roleList(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::select('id', 'name')->orderBy('created_at', 'DESC')->get();
            return Datatables::of($roles)->addColumn('action', function ($role) {
                return '<div class="btn-group"><a class="btn btn-primary" href="' . route('permission.index', ['id' => $role->id]) . '">نمایش</a><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu"><li><a class="remove-role" href="' . route('role.destroy', ['id' => $role->id]) . '">حذف</a></li><li class="divider"></li><li><a class="edit-role" href="' . route('role.edit', ['id' => $role->id]) . '" data-toggle="modal" data-target="#myModal">ویرایش</a></li></ul></div>';
            })
                ->make(true);
        }
        // '.route('permission.index', ['id' => $role->id]).'
    }
    /**
     * [roleStore description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function roleStore(Request $request)
    {
        $this->validate($request, ['role' => 'required']);
        if (!$request->has('id')) {
            Role::create(['name' => $request['role']]);
        } else {
            $role = Role::where('id', $request['id'])->first();
            $role->name = $request['role'];
            $role->slug = null;
            $role->save();
        }
        return response()->json(['success', $this->successStatus]);

    }
    /**
     * [permissionIndex description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function permissionIndex($id)
    {
        $role = Role::where('id', $id)->first();
        $temp = ['no', 'no'];
        $permission = json_decode($role->permissions);
        $permission = $permission == null ? $temp : $permission;
        $users = User::all();
        return view('Admin.user.permission', compact('role', 'permission', 'users'));
    }
    /**
     * [permissionIndex description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function permissionStore(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();
        $permission = array();
        if ($request->all() != null) {
            foreach ($request->all() as $key => $index) {
                $permission[$key] = true;
            }
            $role->permissions = json_encode($permission);
        } else {
            $role->permissions = null;
        }
        $role->save();
        return "ok";
    }
    /**
     * [roleDestroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function roleDestroy($id)
    {
        $role = Role::where('id', $id)->first();
        $role->delete();
        return response()->json(['success', $this->successStatus]);
    }
    /**
     * [roleEdit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function roleEdit($id)
    {
        $role = Role::where('id', $id)->first();
        return view('Admin.user.edit-role', compact('role'));
    }
    /**
     * [user_role description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function user_role(Request $request)
    {
        $this->validate($request, ['name' => 'required|email']);
        $user = User::where('email', $request['name'])->first();
        if ($user != null) {
            $user->roles()->attach($request['id']);
            return "ok";
        } else {
            $message[0] = "کاربر مورد  نظر معتبر نمی باشد";
            return response()->json([$message], 402);
        }

    }
    /**
     * [user_role description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function user_role_delete($user_id, $role_id)
    {
        $user = User::findOrFail($user_id);
        $user->roles()->detach($role_id);
        return redirect()->back();

    }
    /**
     * [UserroleList description]
     * @param Request $request [description]
     */
    public function UserroleList(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::select('id', 'name')->orderBy('created_at', 'DESC')->get();
            return Datatables::of($roles)->addColumn('action', function ($role) {
                return '<div class="btn-group"><a class="btn btn-primary" href="' . route('permission.index', ['id' => $role->id]) . '">نمایش</a><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu"><li><a class="remove-role" href="' . route('role.destroy', ['id' => $role->id]) . '">حذف</a></li><li class="divider"></li><li><a class="edit-role" href="' . route('role.edit', ['id' => $role->id]) . '" data-toggle="modal" data-target="#myModal">ویرایش</a></li></ul></div>';
            })
                ->make(true);
        }
        // '.route('permission.index', ['id' => $role->id]).'
    }

    /**
     * user profile and order list show for admin
     */

    public function user_show($id)
    {
        $user = User::where('id', $id)->first();
        return view('Admin.user.user-show', compact('user'));
    }

    /**
     * user order list show with datatable
     */

    public function user_show_order(Request $request, $id)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $orders = Order::select(DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'name', 'status', 'pay_method', 'pay_status', 'price')->where('user_id', $id)->orderBy('status', 'ASC');
            return Datatables::of($orders)->addColumn('action', function ($order) {
                return '<a class="btn btn-default" href="' . route('sell.show', ['id' => $order->id]) . '">نمایش</a>';
            })
                ->addColumn('row', function ($i = 0) {
                    return $i++;
                })
                ->editColumn('status',
                    '@if($status == 0)<span class="btn btn-primary"> درحال بررسی </span>
						@elseif($status == 1) <span class="btn btn-info"> تایید شد </span>
						@elseif($status == 2) <span class="btn btn-success"> ارسال شد </span>
						@elseif($status == 3) <span class="btn btn-warning"> تایید نشد </span>
						@else <span class="btn btn-danger"> مرجوعی </span>
						@endif')
                ->editColumn('pay_method',
                    '@if($pay_method == 1) پرداخت آنلاین
						@else پرداخت در محل
						@endif')
                ->editColumn('pay_status',
                    '@if($pay_status == 0) پرداخت نشده
						@else پرداخت شده
						@endif')->escapeColumns([])
                ->make(true);
        }
    }

    /**
     * show newsletter form
     */

    public function newsletter_show()
    {
        $users = Newsletter::all()->count();
        return view('Admin.newsletter.newsletter', compact('users'));
    }

    /** sen mail for newsletter accounts */

    public function newsletter_send(Request $request)
    {
        $this->validate($request, ['title' => 'required|string', 'body' => 'required|string']);
        $users = Newsletter::all();
        $name = Setting::first();
        foreach ($users as $user) {
            $to = $user->email;
            $subject = " خبرنامه " . $name->name . '|' . $request->title;
            $body = $request->body;
            $mail = $name->contact_email;
            $store = " فروشگاه اینترنتی " . $name->name;
            $email = \Mail::send('emails.newsletter', ['title' => $request->title, 'body' => $body], function ($message) use ($mail, $subject, $to, $store) {
                $message->from($mail, $store);
                $message->to($to)->subject($subject);
            });
        }
        return "ok";
    }

    /**
     * Checkout  Page
     */
    public function checkout()
    {
        $allIncome = Order::where('pay_method', 1)->where('pay_status', 1)->sum('price');
        $monthIncome = Order::where('pay_method', 1)->where('pay_status', 1)->whereDate('created_at', '>', Carbon\Carbon::now()->subMonth())->sum('price');
        $paid = Checkout::where('status', 1)->sum('price');
        $unpaid = $allIncome - $paid;
        $paidLists = Checkout::all();
        return view('Admin.checkout.checkout', compact('paidLists', 'monthIncome', 'paid', 'unpaid'));

    }

    public function checkoutPayCart(Request $request)
    {

        $this->validate($request, ['name' => 'required', 'cartNum' => 'required|digits:16', 'shaba' => 'required']);
        try {

            $paid = Checkout::all()->sum('price');
            $allIncome = Order::where('pay_method', 1)->where('pay_status', 1)->sum('price');
            $unpaid = $allIncome - $paid;

            if ($unpaid == 0) {
                $data = ['0' => 'مبلغی جهت تسویه حساب موجود نیست'];
                return response()->json(['errors' => $data], 422);
            }
        } catch (\Exception$e) {
            $data = ['0' => 'در حال حاظر سیستم قادر به پاسخگویی نیست لطفا ساعاتی بعد مجددا تلاش کنید'];
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }

    /**
     * Agree checkout pay Status
     */
    public function checkoutStatusAgree($refId)
    {
        $checkout = Checkout::where('refId', $refId)->firest();
        $checkout->status = 1;
        $checkout->save();
    }

}
