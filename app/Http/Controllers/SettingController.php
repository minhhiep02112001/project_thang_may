<?php

namespace App\Http\Controllers;

use App\Model\Category;
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
            orWhere('key', 'categories_home')->
            orWhere('key', 'tax')->get();
            $setting = [];

            foreach ($arr as $item) {
                if ($item['key'] == "categories_home") $item['value'] = $arrId = json_decode($item['value']);
                $setting[$item['key']] = $item['value'];
            }

            $categories = Category::where('is_active', 1)->where(function ($query) {
                return $query->where('type', 0)->orWhere('type', 1);
            })->select('id', 'name', 'image', 'slug', 'parent_id', 'type')->get();

            if (!empty($arrId)) {
                $arrId = array_column($arrId , 'id');
                $categories = $categories->whereNotIn('id' , $arrId);
            }

            return view('admin.setting.index', compact('setting', 'categories'));
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

        return redirect()->route('setting.index')->with('success', 'Tạo thành công !!!');
    }

    function changeCategoryHome(Request $request)
    {
        $data = data_tree_api_menu_class($request->menus);
        try {
            Setting::updateOrCreate(
                [
                    'key' => 'categories_home'
                ], [
                    'key' => 'categories_home',
                    'value' => json_encode($data),
                ]
            );
            return response()->json([
                "status" => true,
                "message" => "Thành công"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "status" => false,
                "message" => $ex->getMessage()
            ], 500);
        }
    }
}
