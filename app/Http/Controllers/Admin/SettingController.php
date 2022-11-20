<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public $successStatus = 200;
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $setting = Setting::first();
        $themes = unserialize($setting->theme);
        return view('Admin.setting.setting', compact('setting', 'themes'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            // $this->validate($request,['width'=>'numeric|min:50|max:100']);
            $setting = Setting::first();
            $setting = $setting == null ? new Setting() : $setting;

            $setting->name = $request['name'];
            $setting->perfix = $request['perfix'];
            $setting->keyword = $request['keyword'];
            $setting->disable_message = $request['disable_message'];
            $setting->description = $request['description'];
            $setting->logo = $request['logo'];
            $setting->admin_email = $request['admin_email'];
            $setting->contact_email = $request['contact_email'];
            $setting->contact_number = $request['contact_number'];
            $setting->contact_address = $request['contact_address'];
            $setting->google_code = $request['google_code'];
            $setting->alexa_code = $request['alexa_code'];
            $setting->analytics_code = $request['analytics_code'];
            $setting->setad_code = $request['setad_code'];
            $setting->etemad_code = $request['etemad_code'];
            $setting->senf_code = $request['senf_code'];
            $setting->about = $request['about'];
            $setting->roles = $request['roles'];
            $setting->faq = $request['faq'];
            $setting->telegram = $request['telegram'];
            $setting->instagram = $request['instagram'];
            $setting->aparat = $request['aparat'];
            $setting->agency = $request['agency'];
            $setting->status = $request->has('status') ? 1 : 0;
            $setting->app_status = $request->has('app_status') ? 1 : 0;
            $setting->app_error = $request['app_error'];
            $setting->app_version = $request['app_version'];
            $theme = [
                'menu-frame' => $request['color-1'] ? $request['color-1'] : null,
                'menu-1' => $request['color-2'] ? $request['color-2'] : null,
                'menu-2' => $request['color-3'] ? $request['color-3'] : null,
                'width' => $request['width'] ? $request['width'] : null,
                'header-price' => $request['color-4'] ? $request['color-4'] : null,
                'footer' => $request['color-5'] ? $request['color-5'] : null,
                'body' => $request['color-6'] ? $request['color-6'] : null,
                'user-loading' => $request['color-7'] ? $request['color-7'] : null,
                'admin-1' => $request['color-8'] ? $request['color-8'] : null,
                'admin-2' => $request['color-9'] ? $request['color-9'] : null,
                'admin-loading' => $request['color-10'] ? $request['color-10'] : null,
            ];
            $themes = serialize($theme);
            $setting->theme = $themes;
            $setting->tel_bot_api = $request["tel_bot_api"];
            $setting->channel_id = $request["channel_id"];
            $setting->save();

            return response()->json("ok", 200);

        }
    }

    /**
     * Upgrade Store
     */
    public function upgrade($date)
    {
        $setting = Setting::first();
        $setting->expiretime = base64_decode(base64_decode($date));
        $setting->save();
        return "ok";
    }
}
