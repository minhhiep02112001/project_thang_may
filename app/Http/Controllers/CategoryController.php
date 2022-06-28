<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    //private $Category;


  /*
Controller method   Policy method
    index               viewAny
    show                view
    create              create
    store               create
    edit                update
    destroy             delete
*/

    public function __construct()
    {
        $this->authorizeResource(Category::class , 'danh_muc');
    }

    protected function resourceAbilityMap()
    {
        return array_merge(parent::resourceAbilityMap(), ['index' => 'view']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $arrCategory = Category::orderBy('type','desc')->orderBy('parent_id','asc')->paginate(10);

        if($request->has('search')){

            $arrCategory = Category::where('name','like',"%{$request->get('search')}%")->paginate(10);
        }

        return view('admin.category.index' , compact('arrCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::where('parent_id',0)->get();
        return  view('admin.category.create' , ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate dữ liệu :
        $validated = $request->validate(
            [
                'name' => "required|unique:categories,name|max:255",
                'image' => 'mimes:jpg,png,jpeg,gif,svg',
                'type' => 'required'
            ],
            [
                'name.required'=> 'Tên danh mục không được để trống !!!',
                'name.unique' => 'Tên danh mục đã tồn tại !!!',
                'name.max' => 'Tên danh mục không được quá 255 ký tự !!!',
                'image.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
            ]
        );
        // Xử lý file
        $image = '';
        if($request->hasFile('image')){
            $folder = './uploads/category/';
            $file =  $request->file('image')->getClientOriginalName();
            while(file_exists($folder.$file)){
                $file = str_random(10).'_'.$file;
            }
            $request->file('image')->move($folder , $file);
            $image = $folder.$file;
        }

        // Thêm mới category
        try{
            // Sử dụng cơ chế ORM
            DB::beginTransaction();
            Category::create([
                'name'=>$request->name,
                'parent_id'=> ($request->type) ? 0 : $request->parent_id,
                'is_active' => ($request->is_active != null)?1:0,
                'position' => $request->position,
                'slug' => str_slug($request->name),
                'type' => $request->type,
                'description' => $request->description??''

            ]);
            DB::commit();

        }catch(\Exception $ex){
            dd($ex);
            if($image!=''){ unlink($image); }
            DB::rollback();
            return redirect()->back()->with('error','Lỗi ')->withInput();
        }

        return redirect()->route('danh-muc.index')->with('success','Thêm thành công !!!');
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
    public function edit( Category $danh_muc )
    {
        //
        $categories =Category::where('parent_id',0)->get();
        return view('admin.category.edit', [
            'category' => $danh_muc,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $danh_muc)
    {
        // validate dữ liệu
        $validated = $request->validate(
            [
                'name' => "required|unique:categories,name,$danh_muc->id|max:255",
                'image' => 'mimes:jpg,png,jpeg,gif,svg',
            ],
            [
                'name.required'=> 'Tên danh mục không được để trống !!!',
                'name.unique' => 'Tên danh mục đã tồn tại !!!',
                'name.max' => 'Tên danh mục không được quá 255 ký tự !!!',
                'image.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
            ]
        );

        $image = "";

        if($request->hasFile('image')){
            $folder = './uploads/category/';
            $file =  $request->file('image')->getClientOriginalName();
            while(file_exists($folder.$file)){
                $file = str_random(10).'_'.$file;
            }
            $request->file('image')->move($folder , $file);
            $image = $folder.$file;
        }

        try{
            DB::beginTransaction();
            DB::table('categories')->where('id',$danh_muc->id)->update([
                'name'=>$request->name,
                'parent_id'=> ($request->type) ? 0 : $request->parent_id,
                'is_active' => ($request->is_active != null)?1:0,
                'position' => $request->position,
                'slug' => str_slug($request->name),
                'image'=> ($image != "")?$image:$danh_muc->image,
                'type' => $request->type,
                'description' => $request->description ?? ''
            ]);
            DB::commit();

            if($image != ""){
                if(file_exists($danh_muc->image)){
                    unlink($danh_muc->image);
                }
            }
        }catch(\Exception $ex){
            if($image != ""){
                unlink($image);
            }
            DB::rollback();
            return redirect()->back()->with('error','Lỗi ')->withInput();
        }

        return redirect()->route('danh-muc.index')->with('success' , 'Sửa thành công !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $danh_muc)
    {
        //
         $old_image = $danh_muc->image;
        $status = $text = $iconColor = '';
        if($danh_muc->delete()){
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
