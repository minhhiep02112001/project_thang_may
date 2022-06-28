<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{
    //
    public function index()
    {
        // code...
        if (Gate::forUser(Auth::user())->allows('setting-website')) {

            $arr = Setting::select('key', 'value')->where('key', 'logo_header')->
            orWhere('key', 'logo_header')->
            orWhere('key', 'website')->
            orWhere('key', 'logo_icon')->
            orWhere('key', 'logo_footer')->
            orWhere('key', 'meta_title')->
            orWhere('key', 'meta_description')->
            orWhere('key', 'meta_keyword')->
            orWhere('key', 'email')->
            orWhere('key', 'link_facebook')->
            orWhere('key', 'address')->
            orWhere('key', 'phone')->
            orWhere('key', 'introduce')->
            orWhere('key', 'tax')->get()->toArray();
            $setting = [];
            foreach ($arr as $key => $value) {
                $setting[$value['key']] = $value['value'];
            }

            return view('admin.setting.index', compact('setting'));
        } else {
            return abort('403');
        }


    }

    public function update(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $folder = './uploads/setting/';
                $fileName = $file->getClientOriginalName();
                while (file_exists($folder . $fileName)) {
                    $fileName = str_random(10) . '_' . $fileName;
                }
                $file->move($folder, $fileName);
                $value = $folder . $fileName;
            }
            Setting::updateOrCreate(
                [
                    'key' => $key
                ], [
                    'key' => $key,
                    'value' => $value,
                ]
            );
        }
        dd("done");
        return redirect()->route('setting.index')->with('success', 'Tạo thành công !!!');

    }
}
