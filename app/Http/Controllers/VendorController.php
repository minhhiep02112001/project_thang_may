<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Vendor;
use Illuminate\Support\Facades\DB;
class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->authorizeResource(Vendor::class , 'nha_cung_cap');
    }

    protected function resourceAbilityMap()
    {
        return array_merge(parent::resourceAbilityMap(), ['index' => 'view']);
    }

    public function index(Request $request)
    {
        //
        $vendors = Vendor::latest()->paginate(5);
          if($request->has('search')){

            $vendors = Vendor::where('name','like',"%{$request->get('search')}%")->paginate(5);
        }
        return view('admin.vendors.index' , ['vendors'=>$vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function store(Request $request)
    {
        // validate
        $validated = $request->validate( 
            [
                'name' => "required|unique:vendors,name|max:255",
                'image' => 'mimes:jpg,png,jpeg,gif,svg'
            ],
            [
                'name.required'=> 'Tên nhà cung cấp không được để trống !!!',
                'name.unique' => 'Tên nhà cung cấp đã tồn tại !!!',
                'name.max' => 'Tên nhà cung cấp không được quá 255 ký tự !!!',
                'image.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
            ]
        );
        $image = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            while(file_exists("./uploads/vendors/$fileName")){
                $fileName = str_random(10).$fileName;
            }
            $file->move('./uploads/vendors' , $fileName);
            $image = "./uploads/vendors/$fileName";
        }
        try{
            DB::beginTransaction();
            Vendor::insert([
                'name' => $request->name, 
                'slug' => str_slug($request->name), 
                'email' => $request->email,
                'phone' => $request->phone, 
                'image' => $image, 
                'website' => $request->website, 
                'address' => $request->address, 
                'position' => $request->position, 
                'is_active' => ($request->is_active) ? 1 : 0
            ]);
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback();
            if($image != ''){
                unlink($image);
            }
        }
        return redirect()->route('nha-cung-cap.index')->with('success','Thêm thành công');
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
    public function edit(Vendor $nha_cung_cap)
    {
        //
        return view('admin.vendors.edit',['vendor' => $nha_cung_cap]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $nha_cung_cap)
    {
        // validate dữ liệu
        $validated = $request->validate( 
            [
                'name' => "required|unique:vendors,name,$nha_cung_cap->id|max:255",
                'image' => 'mimes:jpg,png,jpeg,gif,svg'
            ],
            [
                'name.required'=> 'Tên nhà cung cấp không được để trống !!!',
                'name.unique' => 'Tên nhà cung cấp đã tồn tại !!!',
                'name.max' => 'Tên nhà cung cấp không được quá 255 ký tự !!!',
                'image.mimes' => 'Image không hợp lệ [ jpg , png , jpeg , gif , svg ]',
            ]
        );

        $old_image = $nha_cung_cap->image;
        $image = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            while(file_exists("./uploads/vendors/$fileName")){
                $fileName = str_random(10).$fileName;
            }
            $file->move('./uploads/vendors' , $fileName);
            $image = "./uploads/vendors/$fileName";
        }
        try{
            DB::beginTransaction();
            $nha_cung_cap->update([
                'name' => $request->name, 
                'slug' => str_slug($request->name), 
                'email' => $request->email,
                'phone' => $request->phone, 
                'image' => ($image != '') ? $image : $old_image, 
                'website' => $request->website, 
                'address' => $request->address, 
                'position' => $request->position, 
                'is_active' => ($request->is_active) ? 1 : 0
            ]);
            DB::commit();
            if ($image != '') {
                if(file_exists($old_image)){
                    unlink($old_image);
                }
            }
        }catch(\Exception $ex){
            if ($image != '') {
                if(file_exists($image)){
                    unlink($image);
                }
            }
            DB::rollback();
        }
        return redirect()->route('nha-cung-cap.index')->with('success' , 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $nha_cung_cap)
    {
        //
         $old_image = $nha_cung_cap->image;
        $status = $text = $iconColor = '';
        if($nha_cung_cap->delete()){
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
        ] , 200);
    }
}
