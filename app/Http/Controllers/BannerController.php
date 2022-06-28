<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Banner;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->authorizeResource(Banner::class , 'banner');
    }

    protected function resourceAbilityMap()
    {
        return array_merge(parent::resourceAbilityMap(), ['index' => 'view']);
    }

    public function index(Request $request)
    {
        //
        $banners = Banner::latest()->orderBy('type','asc')->paginate(10);
        if($request->has('search')){

            $banners = Banner::where('title','like',"%{$request->get('search')}%")->paginate(10);
        }
        $rank = $banners->firstItem();
        return view('admin.banner.index' , ['banners'=>$banners , 'rank' => $rank]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate dữ liệu
        $validated = $request->validate(
            [
                'title' => "required|unique:banners,title|max:255",
                'image' => 'required|mimes:jpg,png,jpeg,gif,svg',
            ],
            [
                'title.required'=> 'Tiêu đề không được để trống !!!',
                'title.unique' => 'Tiêu đề đã tồn tại !!!',
                'title.max' => 'Tiêu đề không được quá 255 ký tự !!!',
                'image.required'=> 'Image không được để trống !!!',
                'image.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
            ]
        );
        $image = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $folder = './uploads/banner/';
            $fileName =  $file->getClientOriginalName();
            while(file_exists($folder.$fileName)){
                $fileName = str_random(10).'_'.$fileName;
            }
            $file->move($folder , $fileName);
            $image = $folder.$fileName;
        }
        try{
            DB::beginTransaction();
            Banner::insert([
                'title' => $request->title,
                'slug' => str_slug($request->title),
                'image' => $image,
                'url' => $request->url,
                'target' => $request->target,
                'description' => $request->description,
                'type' => $request->type,
                'position' =>  $request->position,
                'is_active' => ( $request->is_active )? $request->is_active : 0,
            ]);
            DB::commit();
        }catch(\Exception $ex){
            if($image != ''){
                unlink($image);
            }
            DB::rollback();
        }
        return redirect()->route('banner.index');
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
    public function edit(Banner $banner)
    {
        //

        return view('admin.banner.edit' , ['banner' => $banner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
        $validated = $request->validate(
            [
                'title' => "required|unique:banners,title,$banner->id|max:255",
                'image' => 'mimes:jpg,png,jpeg,gif,svg',
            ],
            [
                'title.required'=> 'Tiêu đề không được để trống !!!',
                'title.unique' => 'Tiêu đề đã tồn tại !!!',
                'title.max' => 'Tiêu đề không được quá 255 ký tự !!!',
                'image.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
            ]
        );
        $old_image = $banner->image;
        $image = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $folder = './uploads/banner/';
            $fileName =  $file->getClientOriginalName();
            while(file_exists($folder.$fileName)){
                $fileName = str_random(10).'_'.$fileName;
            }
            $file->move($folder , $fileName);
            $image = $folder.$fileName;
        }
        try{
            DB::beginTransaction();
            $banner->update([
                'title' => $request->title,
                'slug' => str_slug($request->title),
                'url' => $request->url,
                'target' => $request->target,
                'image' => ($image != '')? $image : $old_image,
                'description' => $request->description,
                'type' => $request->type,
                'position' =>  $request->position,
                'is_active' => ( $request->is_active )? $request->is_active : 0,
            ]);
            DB::commit();
            if($image != ''){
                if(file_exists($old_image)){
                    unlink($old_image);
                }
            }
        }catch(\Exception $ex){

            dd($ex);
            if($image != ''){
                if(file_exists($image)){
                    unlink($image);
                }
            }
            DB::rollback();
        }
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
         $old_image = $banner->image;
        $status = $text = $iconColor = '';
        if($banner->delete()){
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
