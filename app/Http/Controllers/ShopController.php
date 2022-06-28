<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Article;
use App\Model\Product;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Order;
use App\Model\Setting;
use App\Model\ProductImage;
use App\Model\Contact;
use App\Model\Banner;
use App\Model\OrderDetail;
use App\User;
use Validator;
use Hash;
use Auth;
use Cookie;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ShopController extends ClientController
{
    //trang chủ
    protected $viewedArticles = [];

    public function __construct()
    { 
        parent::__construct();
    }




    // trang chủ
    public function index()
    {
        //
        $banners = Banner::where([
            'is_active'=>1,
            'type'=>0
        ])->orderBy('position','asc')->get();

        $brands  = Brand::where('is_active',1)->orderBy('position','asc')->get();

        $data =[];
        foreach($this->categories as $item){
            $arr = [];
            $arr['parent'] = $item;

            $ids = $item->categoryChildrens()->where('is_active',1)->pluck('id')->toArray();
            array_push( $ids, $item->id );

            $arr['children'] = Product::where('is_active',1)->whereIn('category_id' , $ids)->limit(10)->orderBy('created_at','desc')->get();
            array_push($data,$arr);
        }

        $arrArticlesHot = Article::where([
            'is_active' => 1,
        ])->orderBy('created_at','desc')->take(3)->get();

        return view('frontend.index', [
            'banners'=>$banners,
            'data' => $data ,
            'brands' => $brands,
            'arrArticlesHot' => $arrArticlesHot
        ]);
    }



    // Danh sách sản phẩm theo danh mục
    public function getListProductsByCategory($slug = null , Request $request)
    {
        // lấy 12 sản phẩm bán chạy nhất ( số lượng mua nhiều nhất)
        $sellingProducts = Product::where('is_active' , 1)->whereIn('id' , OrderDetail::selectRaw('product_id, SUM(qty) as sumOfQty')->groupBy('product_id')->orderBy('sumOfQty', 'DESC')->pluck('product_id')->toArray())->take(12)->get();

        // lấy banner danh mục :
        $banner = Banner::where(['is_active'=>1 , 'type'=>1 ])->orderBy('position','asc')->first();

        $category = Category::where(['slug' => $slug])->firstOrFail();

        $ids = $category->categoryChildrens()->where('is_active',1)->pluck('id')->toArray();
        array_push($ids , $category->id);


        $products = Product::where('is_active',1)->whereIn('category_id' , $ids)->orderBy('created_at','desc')->paginate(12);

        $arrIdBrand = Product::where('is_active',1)->whereIn('category_id' , $ids)->distinct()->pluck('brand_id')->toArray();

        $brands = Brand::where('is_active' , 1)->whereIn('id',$arrIdBrand)->get();

        if($request->has('brand')){
            $products = Product::where('is_active',1)->whereIn('category_id' , $ids)->whereIn('brand_id' , explode(',',$request->brand) )->paginate(12);
        }

        if ($request->has('price')) {
            $sql = "";
            foreach(explode(',',$request->price) as $key){
                $item = explode('-' ,$key);
                if(count($item) > 1){
                    $sql .= "or sale between $item[0] and $item[1] ";
                }else{
                    $sql .= "or sale >= $item[0] ";
                }

            }
            $products = Product::where('is_active',1)->whereIn('category_id' , $ids)->where(function ($query) use ($sql) {
                return $query->whereRaw( trim($sql , "or") )->get();
            })->paginate(12);

            if($request->has('brand')){
                $products = Product::where('is_active',1)->whereIn('category_id' , $ids)->where(function ($query) use ($sql) {
                    return $query->whereRaw( trim($sql , "or") )->get();
                })->whereIn('brand_id' , explode(',',$request->brand) )->paginate(12);
            }
        }

        return  view('frontend.listProduct', compact('category' , 'products' , 'brands', 'banner' , 'sellingProducts'));
    }

    // Chi tiết sản phẩm
    public function detailProduct($slug = null)
    {

        $banner = Banner::where(['is_active'=>1 , 'type'=>2 ])->orderBy('position','asc')->first(); // lấy  banner

        $product = Product::where(['slug' => $slug , 'is_active' => 1 ])->firstOrFail(); /// hiển thị sản phẩm
        if($product == null){
            return abort( 404);
        }

        $viewedProducts = []; // sản phẩm đã xem khi click
        if (isset($_COOKIE['viewed-product'])) {
            $_list = json_decode($_COOKIE['viewed-product']);
            if(!in_array($product->id , $_list)){
                array_push($_list , $product->id);
                setCookie('viewed-product', json_encode($_list) , time() + (86400));
            }
            $viewedProducts = Product::where(['is_active' => 1])->whereIn('id' , array_reverse($_list))->get();

        }
        else{
            $arrViewedProduct[] = $product->id;
            setCookie('viewed-product', json_encode($arrViewedProduct) , time() + (86400));
        }

        $product_images = ProductImage::where([
            'product_id'=> $product->id,
            'is_active' => 1
        ])->orderBy('position','asc')->get(); /// Hình ảnh kèm theo

        $arrProductAttach = Product::where('id','!=',$product->id)->where([
            'category_id' => $product->category_id ,
            'is_active' => 1
        ])->take(10)->get();  //// Sản Phẩm Cùng Danh Mục


        return view('frontend.detailProduct' , compact('banner','product' , 'arrProductAttach' , 'product_images'));
    }


    // danh sách tin tức :
    public function listArticles( $slug = null , Request $request){

        $banner = Banner::where(['is_active'=>1 , 'type'=>3 ])->orderBy('position','asc')->first();

        $listArticles = Article::where('is_active' , 1)->orderBy('id','desc')->paginate(5);

        $title_article = "Tin Tức";


        $arrArticlesNew = Article::where('is_active' , 1)->orderBy('id','desc')->take(4)->get();

        if ($slug) {
            $cateArticle = Category::where([
                'slug' => $slug,
                'is_active' => 1
            ])->firstOrFail();
            $title_article =$cateArticle->name;
            $listArticles = Article::where([
                'type' => $cateArticle->id,
                'is_active' => 1
            ])->orderBy('id','desc')->paginate(5);

        }

        $title_search = null;
        if($request->has('query')){
            $query = str_slug($request->get('query'));
            $title_search = "Kết quả tìm kiếm : $query";
            $listArticles = Article::where('slug','like',"%{$query}%")->paginate(5);
        }

        return view('frontend.listArticle' , compact('listArticles','title_search' , 'banner' , 'title_article' , 'arrArticlesNew'));
    }

    // chi tiết tin tức
    public function detailArticle($slug = null)
    {
        //
        $banner = Banner::where(['is_active'=>1 , 'type'=>4 ])->orderBy('position','asc')->first();
        $arrArticlesNew = Article::where('is_active' , 1)->orderBy('id','desc')->take(4)->get();
        $article = Article::where('slug',$slug)->firstOrFail();

        $viewedArticles = [];

        if (Cookie::has('viewed-articles')) {

            $_list = json_decode(Cookie::get('viewed-articles'));
            if(!in_array($article->id , $_list)){
                array_push($_list , $article->id);
                Cookie::queue('viewed-articles', json_encode($_list) , time() + (86400));
            }
            $viewedArticles = Article::where(['is_active' => 1])->whereIn('id' , array_reverse($_list))->get();

        }
        else{
            $_list[] = $article->id;
            Cookie::queue('viewed-articles', json_encode($_list) , time() + (86400));
            $viewedArticles = Article::where(['is_active' => 1])->whereIn('id' , array_reverse($_list))->get();
        }

        /// Lấy tin tức đã xem trong laravel thông qua cookie()



        ///lấy 8 bài viết liên quan theo (type)
        $listArticles = Article::where([
            'type' => $article->type ,
            'is_active' => 1
        ])->orderBy('created_at','desc')->take(8)->get();

        return view('frontend.detailArticle',compact('article' , 'banner'  , 'viewedArticles', 'arrArticlesNew' , 'listArticles' ));
    }

    //trang liên hệ
    public function contact()
    {
        //
        $banner = Banner::where(['is_active'=>1 , 'type'=>5 ])->orderBy('position','asc')->first();
        return view('frontend.contact' , compact('banner'));
    }

    public function postContact(Request $request)
    {
        $validated = $request->validate([
            'contact'=>'required|min:1'
        ],[
            'contact.required' =>'Nội dung không được để trống'
        ]);
         try{
            DB::beginTransaction();
            Contact::create([
                'name'=>$request->name,
                'phone' => $request->phone,
                'email'  => $request->email,
                'content' => $request->get('content')
            ]);
            DB::commit();
         }catch(\Exception $ex){
            DB::rollback();
         }
         return redirect()->route('contact')->with('status','Cảm ơn bạn đã góp ý với chúng tôi');
    }

    // tìm kiếm
    public function search(Request $request){

        $banner = Banner::where(['is_active'=>1 , 'type'=>7 ])->orderBy('position','asc')->first();

        if($request->has('view') && $request->view == 'json'){ // lấy dữ liệu ajax khi tồn tại view json
            $query = str_slug($request->get('query'));
            $products = Product::where('slug','like',"%{$query}%")->where('is_active',1)->select('name','price','sale','image','slug')->get();
            return response()->json([
                'results_total' => $products->count(),
                'results' => $products->toJson(),
            ],200);
        }
        $products = null;
        $total = null;
        if($request->has('query')){
            $query = str_slug($request->get('query'));
            $products = Product::where('slug','like',"%{$query}%")->where('is_active' , 1)->paginate(12);
            $total = Product::where('name','like',"%{$query}%")->where('is_active' , 1)->count();
        }

        return view('frontend.search' , compact('products','total' , 'banner'));
    }


// đăng nhập
    public function login()
    {
        if(Auth::guard('customer')->check()){
            return redirect()->route('trangchu');
        }
        return view('frontend.login');
    }
    public function postLogin(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|exists:users|email',
            'password' => 'min:6|required|string',
        ],[

            'email.exists' =>'Email không tồn tại !!!',
            'email.required' =>'Email không được để trống  !!!',
            'email.email' =>'Email không đúng định dạng  !!!',

            'password.min' =>'Mật khẩu phải có ít nhất 6 ký tự !!!',
            'password.string' =>'Mật khẩu phải là chuỗi ký tự !!!',
            'password.required' =>'Mật khẩu không được để trống  !!!'

        ]);

        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //kiểm tra trường remember có được chọn hay không

        if (Auth::guard('customer')->attempt($arr , $request->has('remember'))) {
            $customer = Auth::guard('customer')->user();
            if($customer->is_active){
                return redirect()->route('trangchu');
            }else{
                Auth::guard('customer')->logout();
                return back()->withInput()->with('error','Tài khoản của bạn đã bị khóa');
            }
            //..code tùy chọn
            //đăng nhập thành công thì hiển thị thông báo đăng nhập thành công
        } else {

            return back()->withInput()->with('error','Tài khoản hoặc mật khẩu không chính xác');
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
            'password_confirmation' =>'required'
        ],[
            'name.required'=>'Họ tên không được để trống !!!',
            'email.unique' =>'Email đã tồn tại !!!',
            'email.required' =>'Email không được để trống  !!!',
            'email.email' =>'Email không đúng định dạng  !!!',
            'password.confirmed' =>'Mật khẩu không khớp !!!',
            'password.min' =>'Mật khẩu phải có ít nhất 6 ký tự !!!',
            'password.string' =>'Mật khẩu phải là chuỗi ký tự !!!',
            'password.required' =>'Mật khẩu không được để trống  !!!',
            'password_confirmation.required' =>'Mật khẩu không được để trống  !!!'

        ]);

        User::create([
            'name' => $request->name,
            'is_active'=>1,
            'is_admin' => 0,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return back()->with('message', 'Đăng ký thành công ');
    }


// Hiển thị thông tin cá nhân
    public function informationLogin()
    {

        if(!Auth::guard('customer')->check()){
            return redirect()->route('shop.login');
        }
        $user = Auth::guard('customer')->user();
        $orders = Order::where('user_id','=',$user->id)->orderBy('created_at' , 'desc')->get();
        return view('frontend.informationUserLogin' , compact('user' , 'orders'));
    }
// Thay đổi thông tin cá nhân
    public function changInformation(Request $request)
    {
        // code...

        $validator =$request->validate([
            'name'=>'required|max:255',
            'password' => [
                'nullable',
                'max:255' ,
                function($attribute, $value, $fail) {
                    if ($value != null && strlen($value) < 6) {
                        return $fail($attribute.' phải có ít nhất 6 ký tự');
                    }
                },
                'confirmed',
            ],
        ],[
            'name.required' => 'Tên không được để trống !!!',
            'password.confirmed' =>'Mật khẩu không khớp !!!',
            'password.max' =>'Mật khẩu không được quá 255 ký tự !!!',
        ]);

        $user = User::findOrFail($request->id);
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->save();
        return redirect()->route('shop.informationUser')->with('success' ,'Sửa thành công !!!');
    }


 /// Lỗi không tìm thấy Url :
    public function errorUrl($str)
    {
        return abort(404);
    }

}
