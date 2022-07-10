<?php

use App\Services\ThumbnailService;
use Intervention\Image\Facades\Image;

function getValueSetting($key)
{
    $data = \App\Model\Setting::where('key', $key)->first();
    return !empty($data) ? $data->value : null;
}

if (!function_exists('getImageThumb')) {

    function getImageThumb($imagePath = '', $width = 0, $height = 0)
    {

        $imagePath = trim($imagePath, './');
        try {

            $imageFullPath = public_path($imagePath);

            if (!file_exists($imageFullPath)) {
                return asset("thangmaydep/default.jpg");
            }
            $path = explode('.', $imagePath);
            $newPath = "{$path[0]}-w{$width}-h{$height}.{$path[1]}";

            $savedPath = public_path("images/$newPath");

            $savedDir = dirname($savedPath);

            if (!is_dir($savedDir)) {
                mkdir($savedDir, 777, true);
            }

            Image::make($imageFullPath)->fit($width, $height)->save($savedPath);

            return asset("images/$newPath");
        } catch (\Exception $ex) {
            return asset("thangmaydep/default.jpg");
        }
    }
}

function getCateName($id){
    return \App\Model\Category::select(['id' , 'name' , 'slug' , 'type'])->find($id);
}

function data_tree_api_menu_class($data)
{
    $result = [];
    foreach ($data as $item) {
        if (empty($item)) {
            continue;
        }
        $attr = getCateName($item['id'])->toArray();
        if (!empty($item['children'])) {
            $item['attr'] = $attr;
            $item['children'] = data_tree_api_menu_class($item['children']);
            array_push($result, $item);
        } else {
            $item['attr'] = $attr;
            array_push($result, $item);
        }
    }
    return $result;
}

function getImageConvert($item , $class = "" , $w = 0, $height = 0){
    return "<img src='".getImageThumb($item->image , $w, $height)."' alt='{$item->name}' loading='$class'/>";
}

if (!function_exists('getParentCategory')) {
    function getParentCategory($category)
    {
        
        if (empty($category)) return [];
        $category = $category->categoryParent()->select('id', 'name', 'slug', 'parent_id')->first();
        
        if ($category) {
           
            $data[] = $category;
            $arr = getParentCategory($category);
            $data = array_merge($data, $arr);
        }
        
        return $data ?? [];
    }
}

if (!function_exists('getChildrenCategory')) {
    function getChildrenCategory($categories = [], $parent_id = 0)
    {
        $data = [];
        foreach ($categories as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $data[] = $item;
                $arr = getChildrenCategory($categories, $item['id']);
                $data = array_merge($data, $arr);
                unset($categories[$key]);
            }
        }
        return $data ?? [];
    }
}
