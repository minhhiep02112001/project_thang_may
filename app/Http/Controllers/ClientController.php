<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Setting;

class ClientController extends Controller
{
    
    public $categories;
    public $categoriesArticles;
    public function __construct()
    { 
        $this->categories = Category::where([
            'parent_id'=>0,
            'is_active'=>1,
            'type' => 0
        ])->orderBy('position','asc')->get();

        $this->categoriesArticles = Category::where([
            'parent_id'=>0,
            'is_active'=>1,
            'type' => 1
        ])->orderBy('position','asc')->get();

        $setting = Setting::first();
        
        view()->share([
            'categories' => $this->categories,
            'setting' => $setting,
            'categoriesArticles' => $this->categoriesArticles
        ]); 
    }
}
