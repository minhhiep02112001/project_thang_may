<?php

namespace App\Services;

use App\Model\Category;
use App\Model\Setting;

class SettingClientService
{
    function getAllSettingWebSite()
    {
        $data = Setting::select('key', 'value')->where('key', 'logo_header')->
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
        orWhere('key', 'tax')->get()->toArray();
        $setting = [];
        foreach ($data as $key => $value) {
            $setting[$value['key']] = $value['value'];
        }
        return $setting;
    }

    function getMenu($type = 0)
    {
        $default_select = ['id', 'name', 'slug', 'image', 'position'];
        return Category::where('type', $type)->where('is_active', 1)->select($default_select)->get();
    }

    function getMenuType($type = 0, $parent_id = 0)
    {
        $default_select = ['id', 'name', 'slug', 'image', 'position'];
        return Category::where('type', $type)->where('is_active', 1)->where('parent_id', $parent_id)->select($default_select)->get();
    }
}
