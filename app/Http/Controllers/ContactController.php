<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Contact;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $contacts = Contact::latest()->paginate(10);
        if($request->has('search')){

            $contacts = Contact::where('name','like',"%{$request->get('search')}%")->orWhere('email','like',"%{$request->get('search')}%")->paginate(10);
        }
        return view('admin.contact.index' , compact('contacts'));
    }

    public function destroy(Contact $lien_he)
    {
       
        $status = $text = $iconColor = '';
        if($lien_he->delete()){
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
