<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Article;
use App\Model\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->authorizeResource(Article::class , 'tin_tuc');
    }

    protected function resourceAbilityMap()
    {
        return array_merge(parent::resourceAbilityMap(), ['index' => 'view']);
    }


    public function index(Request $request)
    {
        //
        $articles = Article::latest()->paginate(10);
        if($request->has('search')){

            $articles = Article::where('title','like',"%{$request->get('search')}%")->paginate(10);
        }
        $rank = $articles->firstItem();
        return view('admin.articles.index', compact('articles' , 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categoriesArticles = Category::where('type',1)->get();
        return view('admin.articles.create' , compact('categoriesArticles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate(
            [
                'title' => "required|unique:articles,title|max:255",
                'image' => 'required|file|mimes:jpg,png,jpeg,gif,svg',
                'summary'=>'required',
                'description' => 'required'
            ],
            [
                'name.required'=> 'Tên danh mục không được để trống !!!',
                'name.unique' => 'Tên danh mục đã tồn tại !!!',
                'name.max' => 'Tên danh mục không được quá 255 ký tự !!!',
                'image.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
                'summary.required' =>'Mô tả không được để trống',
                'description.required' => 'Nội dung không được để trống '
            ]
        );



        $image = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $folder = './uploads/article/';
            $fileName =  $file->getClientOriginalName();
            while(file_exists($folder.$fileName)){
                $fileName = str_random(10).'_'.$fileName;
            }
            $file->move($folder , $fileName);
            $image = $folder.$fileName;
        }
        try{
            DB::beginTransaction();

            Article::create([
                'title' => $request->title,
                'slug' => str_slug($request->title),
                'image' => $image,
                'summary' => $request->summary,
                'description' => $request->description,
                'category_id' => $request->type ,
                'position' => $request->position,
                'status' => 0,
                'url' => $request->url,
                'is_active' => ($request->is_active) ? 1 : 0,
                'user_id' => Auth::user()->id,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description
            ]);
            DB::commit();
        }catch(\Exception $ex){
            if($image != ''){
                unlink($image);
            }
            DB::rollback();
        }
        return redirect()->route('tin-tuc.index')->with('success','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Article $tin_tuc)
    {
        //
        $categoriesArticles = Category::where('type',1)->get();
        $article = $tin_tuc;
        return view('admin.articles.edit',compact('article' , 'categoriesArticles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Article $tin_tuc)
    {
        // validate dữ liệu

        $validated = $request->validate(
            [
                'title' => "required|unique:articles,title,$tin_tuc->id|max:255",
                'image' => 'mimes:jpg,png,jpeg,gif,svg',
                'summary'=>'required',
                'description' => 'required'
            ],
            [
                'name.required'=> 'Tên danh mục không được để trống !!!',
                'name.unique' => 'Tên danh mục đã tồn tại !!!',
                'name.max' => 'Tên danh mục không được quá 255 ký tự !!!',
                'image.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
                'summary.required' =>'Mô tả không được để trống',
                'description.required' => 'Nội dung không được để trống '
            ]
        );

        $old_image = $tin_tuc->image;
        $image = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $folder = './uploads/article/';
            $fileName =  $file->getClientOriginalName();
            while(file_exists($folder.$fileName)){
                $fileName = str_random(10).'_'.$fileName;
            }
            $file->move($folder , $fileName);
            $image = $folder.$fileName;
        }

        try{
            DB::beginTransaction();
            $tin_tuc->update([
                'title' => $request->title,
                'slug' => str_slug($request->title),
                'image' => ( $image != '' )? $image : $old_image ,
                'summary' => $request->summary,
                'description' => $request->description,
                'category_id' => $request->type ,
                'position' => $request->position,
                'status' => 0,
                'url' => $request->url,
                'is_active' => ($request->is_active) ? 1 : 0,
                'user_id' => Auth::user()->id,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description
            ]);
            DB::commit();
            if($image != ''){
                if(file_exists($old_image)){
                    unlink($old_image);
                }
            }

        }catch(\Exception $ex){
            if($image != ''){
                if(file_exists($image)){
                    unlink($image);
                }
            }
            DB::rollback();
        }
        return redirect()->route('tin-tuc.index')->with('success','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $tin_tuc)
    {
        //
        // $article = Article::find($id);
        $status = $text = $iconColor = '';
        $old_image = $tin_tuc->image;
        if($tin_tuc->delete()){
            @unlink($old_image);

            $status='success';
            $text='Xóa thành công';
            $iconColor = 'green';
        }else{
            $status='error';
            $text='Xóa không thành công';
            $iconColor = 'red';
        }
        return response()->json([
            'icon'=>$status,
            'text'=>$text,
            'iconColor' => $iconColor
        ]);
    }
}
