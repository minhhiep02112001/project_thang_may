<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->authorizeResource(Brand::class , 'thuong_hieu');
    }

    protected function resourceAbilityMap()
    {
        return array_merge(parent::resourceAbilityMap(), ['index' => 'view']);
    }

    public function index(Request $request)
    {
        //
        $brands = Brand::latest()->paginate(10);

        if($request->has('search')){

            $brands = Brand::where('name','like',"%{$request->get('search')}%")->paginate(10);
        }
        $rank = $brands->firstItem();
        return view('admin.brand.index' , ['brands'=>$brands , 'rank' => $rank]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.brand.create');
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
                'name' => "required|unique:brands,name|max:255",
                'image' => 'mimes:jpg,png,jpeg,gif,svg',
            ],
            [
                'name.required'=> 'Thương hiệu không được để trống !!!',
                'name.unique' => 'Thương hiệu đã tồn tại !!!',
                'name.max' => 'Thương hiệu không được quá 255 ký tự !!!',
                'image.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
            ]
        );
        $image = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            while (file_exists("./uploads/brand/$fileName")) {
                $fileName = str_random(10).$fileName;
            }
            $file->move("./uploads/brand" , $fileName);
            $image = "./uploads/brand/$fileName";
        }
        try{
            DB::beginTransaction();
            DB::table('brands')->insert([
                'name' => $request->name,
                'slug' => str_slug($request->name),
                'website' => $request->website,
                'position' => $request->position,
                'image' => $image,
                'is_active' => ($request->is_active) ? 1 : 0
            ]);
            DB::commit();
        }catch(\Exception $ex){
            if($image != ''){
                unlink($image);
            }
            DB::rollback();
        }
        return redirect()->route('thuong-hieu.index')->with('success', 'Thêm thành công');
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
    public function edit(Brand $thuong_hieu)
    {
        return view('admin.brand.edit' , ['brand'=>$thuong_hieu]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $thuong_hieu)
    {
        $validated = $request->validate(
            [
                'name' => "required|unique:brands,name,$thuong_hieu->id|max:255",
                'image' => 'mimes:jpg,png,jpeg,gif,svg',
            ],
            [
                'name.required'=> 'Thương hiệu không được để trống !!!',
                'name.unique' => 'Thương hiệu đã tồn tại !!!',
                'name.max' => 'Thương hiệu không được quá 255 ký tự !!!',
                'image.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
            ]
        );
        $old_image = $thuong_hieu->image;
        $image = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            while (file_exists("./uploads/brand/$fileName")) {
                $fileName = str_random(10).$fileName;
            }
            $file->move("./uploads/brand" , $fileName);
            $image = "./uploads/brand/$fileName";
        }
        try{
            DB::beginTransaction();
            $thuong_hieu->update([
                'name' => $request->name,
                'slug' => str_slug($request->name),
                'website' => $request->website,
                'position' => $request->position,
                'image' => ($image != '') ? $image : $old_image,
                'is_active' => ($request->is_active) ? 1 : 0
            ]);
            DB::commit();
            if( $image != '' && file_exists($old_image)){
                unlink($old_image);
            }
        }catch(\Exception $ex){
            dd($ex);
            if($image != ''){
                unlink($image);
            }
            DB::rollback();
        }
        return redirect()->route('thuong-hieu.index')->with('success','Sửa thành công');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $thuong_hieu)
    {
        $status = $text = $iconColor = '';
        $old_image = $thuong_hieu->image;
        if($thuong_hieu->delete()){
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
        //
    }
}
