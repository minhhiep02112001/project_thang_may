<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Coupon;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->authorizeResource(Coupon::class , 'khuyen_mai');
    }

    protected function resourceAbilityMap()
    {
        return array_merge(parent::resourceAbilityMap(), ['index' => 'view']);
    }


    public function index(Request $request)
    {
        //
        $arrCoupon = Coupon::latest()->paginate(10);
        if($request->has('search')){

            $arrCoupon = Coupon::where('code','like',"%{$request->get('search')}%")->paginate(10);
        }
        $rank = $arrCoupon->firstItem();
        return view('admin.coupon.index',compact('arrCoupon' , 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.coupon.create');
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
        $validated = $request->validate([
            'code'=>[
                'required',
                'unique:coupons,code',
                'min:6',
                'regex:/^[A-Za-z0-9_-]+$/'
            ],

            'percent' =>'min:0|max:100',

        ],[
            'code.required'=>'Mã khuyến mại không được để trống',
            'code.min'=>'Mã khuyến mại phải có ít nhất 6 ký tự',
            'code.regex'=>'Mã khuyến mại không được chứa ký tự đặc biệt',
            'percent.min'=>'Giá trị bé nhất 0%',
            'percent.max'=>'Giá trị lớn nhất 100%',

        ]);
        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->value = $request->value;
        $coupon->percent = $request->percent;
        $coupon->is_active = ($request->is_active)?1:0;
        $coupon->type = $request->type;
        $coupon->unti = $request->unti;
        $coupon->save();
        return redirect()->route('khuyen-mai.index')->with('success' , 'Thêm thành công');
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
    public function edit(Coupon $khuyen_mai)
    {
        //
        return view('admin.coupon.edit',['coupon' => $khuyen_mai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $khuyen_mai)
    {
        $validated = $request->validate([
            'code'=>[
                'required',
                'unique:coupons,code,'.$khuyen_mai->id,
                'min:6',
                'regex:/^[A-Za-z0-9_-]+$/'
            ],

            'percent' =>'min:0|max:100',

        ],[
            'code.required'=>'Mã khuyến mại không được để trống',
            'code.min'=>'Mã khuyến mại phải có ít nhất 6 ký tự',
            'code.regex'=>'Mã khuyến mại không được chứa ký tự đặc biệt',
            'percent.min'=>'Giá trị bé nhất 0%',
            'percent.max'=>'Giá trị lớn nhất 100%',

        ]);

        $khuyen_mai->code = $request->code;
        $khuyen_mai->value = $request->value;
        $khuyen_mai->percent = $request->percent;
        $khuyen_mai->is_active = ($request->is_active)?1:0;
        $khuyen_mai->type = $request->type;
        $khuyen_mai->unti = $request->unti;
        $khuyen_mai->save();
        return redirect()->route('khuyen-mai.index')->with('success' , 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $khuyen_mai)
    {

        $status = $text = $iconColor = '';
        if($khuyen_mai->delete()){
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
