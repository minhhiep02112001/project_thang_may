<?php

namespace App\Http\Controllers\Client;

use App\Model\Category;
use App\Model\Contact;
use App\Model\ProductImage;
use App\Services\SettingClientService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Article;
use App\Model\Banner;
use App\Model\Brand;
use App\Model\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    //trang chủ
    protected $viewedArticles = [];
    protected $clientService;

    function __construct(SettingClientService $settingClientService)
    {

        $this->clientService = $settingClientService;

        $menus_product = $this->clientService->getMenuType(0, 0);

        $menu_projects = $this->clientService->getMenu(1);

        $setting = $this->clientService->getAllSettingWebSite();
        view()->share('setting', $setting);
        view()->share('menus_product', $menus_product);
        view()->share('menu_projects', $menu_projects);
    }


    // trang chủ
    public function index()
    {
        $banners = Banner::where([
            'is_active' => 1,
            'type' => 0
        ])->orderBy('position', 'asc')->select('id', 'title', 'description', 'image', 'slug', 'url', 'target')->get();
        $bannerQuality = Banner::where([
            'is_active' => 1,
            'type' => 7
        ])->orderBy('position', 'asc')->select('id', 'title', 'description', 'image', 'slug', 'url', 'target')->take(6)->get();

        $categories_home = getValueSetting('categories_home');

        if (!empty($categories_home)) {
            $categories_home = json_decode($categories_home);
            $ids = array_column($categories_home, 'id');
        }

        $categories = Category::whereIn('id', $ids ?? [])->where('is_active', 1)->select(['id', 'name', 'slug', 'type'])->get();

        $categories->transform(function ($item) {
            $item->products = $item->products()->select(['products.id', 'products.name', 'products.slug', 'products.image'])->orderBy('updated_at', 'desc')->take(8)->get();
            return $item;
        });
        return view('frontend.index', [
            'banners' => $banners,
            'categories' => $categories,
//            'product_projects' => $product_projects,
            'bannerQuality' => $bannerQuality
        ]);
    }


    // Danh sách sản phẩm theo danh mục
    public function getListProductsByCategory($slug = null, Request $request)
    {

        // Lấy tất cả danh mục cha của  danh mục con;
        $category = Category::where('is_active', 1)->where('slug', $slug)->where(function ($query) {
            return $query->where('type', 0)->orWhere('type', 1);
        })->select('id', 'name', 'image', 'slug', 'parent_id')->first();

        if (!$category) abort(404);

        $categories = Category::where('is_active', 1)->where('type', 0)->select('id', 'name', 'slug', 'parent_id')->get()->toArray();

        $categoryParent = getParentCategory($category);

        $categoryChildren = getChildrenCategory($categories, $category->id);

        if (!empty($categoryChildren)) {
            $arr_id = array_column($categoryChildren, 'id');
            $products = Product::whereIn('category_id', $arr_id)->where('is_active', 1);
        } else {
            $products = Product::where(['is_active' => 1, 'category_id' => $category->id]);
        }

        $products = $products->orderBy('updated_at', 'desc')->select(['id', 'name', 'slug', 'image', 'summary', 'price'])->paginate(12);

        return view('frontend.category', compact('category', 'categoryParent', 'products'));
    }

    // Chi tiết sản phẩm
    public function detailProduct($slug)
    {

        $product = Product::where(['slug' => $slug, 'is_active' => 1])->first(); /// hiển thị sản phẩm
        if ($product == null) return abort(404);

        $viewedProducts = []; // sản phẩm đã xem khi click
        if (isset($_COOKIE['viewed-product'])) {
            $_list = json_decode($_COOKIE['viewed-product']);
            if (!in_array($product->id, $_list)) {
                array_push($_list, $product->id);
                setCookie('viewed-product', json_encode($_list), time() + (86400));
            }
            $viewedProducts = Product::where(['is_active' => 1])->whereIn('id', array_reverse($_list))->get();
        } else {
            $arrViewedProduct[] = $product->id;
            setCookie('viewed-product', json_encode($arrViewedProduct), time() + (86400));
        }
        $category = $product->category()->select('id', 'name', 'slug', 'parent_id')->first();
        $categoryParent = getParentCategory($category);
        $categoryParent[] = $category;

        $product_images = ProductImage::where([
            'product_id' => $product->id,
            'is_active' => 1
        ])->orderBy('position', 'asc')->get(); /// Hình ảnh kèm theo

        $arrProductAttach = Product::where('id', '!=', $product->id)->where([
            'category_id' => $product->category_id,
            'is_active' => 1
        ])->orderBy('updated_at', 'desc')->take(10)->get();  //// Sản Phẩm Cùng Danh Mục

        return view('frontend.product', compact('product', 'category', 'categoryParent', 'arrProductAttach', 'product_images'));
    }


    // danh sách tin tức :
    public function listArticles($slug = null, Request $request)
    {
        $news = Article::where('is_active', 1)->orderBy('updated_at', 'desc')->paginate(10);
        return view('frontend.new', compact('news'));
    }

    // chi tiết tin tức
    public function detailArticle($slug = null)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $viewedArticles = [];

        if (Cookie::has('viewed-articles')) {

            $_list = json_decode(Cookie::get('viewed-articles'));
            if (!in_array($article->id, $_list)) {
                array_push($_list, $article->id);
                Cookie::queue('viewed-articles', json_encode($_list), time() + (86400));
            }
            $viewedArticles = Article::where(['is_active' => 1])->whereIn('id', array_reverse($_list))->get();
        } else {
            $_list[] = $article->id;
            Cookie::queue('viewed-articles', json_encode($_list), time() + (86400));
            $viewedArticles = Article::where(['is_active' => 1])->whereIn('id', array_reverse($_list))->get();
        }

        /// Lấy tin tức đã xem trong laravel thông qua cookie()


        ///lấy 8 bài viết liên quan theo (type)
//        $listArticles = Article::where([
//            'type' => $article->type,
//            'is_active' => 1
//        ])->orderBy('created_at', 'desc')->take(8)->get();

        return view('frontend.detail_new', compact('article', 'viewedArticles'));
    }

    //trang liên hệ
    public function contact()
    {
        //
        $banner = Banner::where(['is_active' => 1, 'type' => 5])->orderBy('position', 'asc')->first();
        return view('frontend.contact', compact('banner'));
    }

    public function postContact(Request $request)
    {
        $validated = $request->validate([
            'contents' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'fullname' => 'required|min:6'
        ], [
            'contact.required' => 'Nội dung không được để trống'
        ]);

        try {
            DB::beginTransaction();
            Contact::create([
                'name' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'content' => $request->get('contents')
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('status', 'Lỗi hệ thống');
        }
        return redirect()->back()->with('status', 'Cảm ơn bạn đã góp ý với chúng tôi');
    }

    // tìm kiếm
    public function search(Request $request)
    {

        $banner = Banner::where(['is_active' => 1, 'type' => 7])->orderBy('position', 'asc')->first();

        if ($request->has('view') && $request->view == 'json') { // lấy dữ liệu ajax khi tồn tại view json
            $query = str_slug($request->get('query'));
            $products = Product::where('slug', 'like', "%{$query}%")->where('is_active', 1)->select('name', 'price', 'sale', 'image', 'slug')->get();
            return response()->json([
                'results_total' => $products->count(),
                'results' => $products->toJson(),
            ], 200);
        }
        $products = null;
        $total = null;
        if ($request->has('query')) {
            $query = str_slug($request->get('query'));
            $products = Product::where('slug', 'like', "%{$query}%")->where('is_active', 1)->paginate(12);
            $total = Product::where('name', 'like', "%{$query}%")->where('is_active', 1)->count();
        }

        return view('frontend.search', compact('products', 'total', 'banner'));
    }


    // đăng nhập
    public function login()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('trangchu');
        }
        return view('frontend.login');
    }

    public function postLogin(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|exists:users|email',
            'password' => 'min:6|required|string',
        ], [

            'email.exists' => 'Email không tồn tại !!!',
            'email.required' => 'Email không được để trống  !!!',
            'email.email' => 'Email không đúng định dạng  !!!',

            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự !!!',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự !!!',
            'password.required' => 'Mật khẩu không được để trống  !!!'

        ]);

        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //kiểm tra trường remember có được chọn hay không

        if (Auth::guard('customer')->attempt($arr, $request->has('remember'))) {
            $customer = Auth::guard('customer')->user();
            if ($customer->is_active) {
                return redirect()->route('trangchu');
            } else {
                Auth::guard('customer')->logout();
                return back()->withInput()->with('error', 'Tài khoản của bạn đã bị khóa');
            }
            //..code tùy chọn
            //đăng nhập thành công thì hiển thị thông báo đăng nhập thành công
        } else {

            return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
            //đăng nhập thất bại hiển thị đăng nhập thất bại
        }
    }

    // đăng xuất
    public function logout()
    {
        // code...
        Auth::guard('customer')->logout();
        return redirect()->route('trangchu');
    }

    //đăng ký
    public function register()
    {

        return view('frontend.register');
    }

    public function postRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'min:6|required|string|confirmed',
            'password_confirmation' => 'required'
        ], [
            'name.required' => 'Họ tên không được để trống !!!',
            'email.unique' => 'Email đã tồn tại !!!',
            'email.required' => 'Email không được để trống  !!!',
            'email.email' => 'Email không đúng định dạng  !!!',
            'password.confirmed' => 'Mật khẩu không khớp !!!',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự !!!',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự !!!',
            'password.required' => 'Mật khẩu không được để trống  !!!',
            'password_confirmation.required' => 'Mật khẩu không được để trống  !!!'

        ]);

        User::create([
            'name' => $request->name,
            'is_active' => 1,
            'is_admin' => 0,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return back()->with('message', 'Đăng ký thành công ');
    }


    // Hiển thị thông tin cá nhân
    public function informationLogin()
    {

        if (!Auth::guard('customer')->check()) {
            return redirect()->route('shop.login');
        }
        $user = Auth::guard('customer')->user();
        $orders = Order::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.informationUserLogin', compact('user', 'orders'));
    }

    // Thay đổi thông tin cá nhân
    public function changInformation(Request $request)
    {
        // code...

        $validator = $request->validate([
            'name' => 'required|max:255',
            'password' => [
                'nullable',
                'max:255',
                function ($attribute, $value, $fail) {
                    if ($value != null && strlen($value) < 6) {
                        return $fail($attribute . ' phải có ít nhất 6 ký tự');
                    }
                },
                'confirmed',
            ],
        ], [
            'name.required' => 'Tên không được để trống !!!',
            'password.confirmed' => 'Mật khẩu không khớp !!!',
            'password.max' => 'Mật khẩu không được quá 255 ký tự !!!',
        ]);

        $user = User::findOrFail($request->id);
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->save();
        return redirect()->route('shop.informationUser')->with('success', 'Sửa thành công !!!');
    }


    function informationWeb()
    {
        return view('frontend.information');
    }

    function getContact()
    {
        return view('frontend.contact');
    }

    /// Lỗi không tìm thấy Url :
    public function errorUrl($str)
    {
        return abort(404);
    }


}
