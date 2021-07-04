<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transections;

class TransectionsController extends Controller
{
    public function index(){
        //returnview ทั่วไป
        //return view('admin.index');
        //$transections = transections::all();
        $transections = transections::all();
        return view('admin.index',compact('transections'));
    }
    public function addTransection(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                
                'transection_Detail'=>"required|max:255",
                'transection_type'=>"required|in:in,out",
                'transection_date'=>"required",
                'transection_amount' => "required|regex:/^\d+(\.\d{1,2})?$/"
            ],
            [
                'transection_Detail.required'=>"กรุณาป้อนข้อมูลแผนก",
                'transection_type.required'=>"กรุณาเลือก รายรับหรือรายจ่าย",
                'transection_Detail.mex'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
                'transection_date.required'=>"กรุณาเลือกหรือกรอก วันที่",
                'transection_amount.required'=>"กรุณาป้อนจำนวน",
                'transection_amount.regex'=>"รูปแบบจำนวนธุรกรรมไม่ถูกต้อง"
            ]
        );

        //dd($request->transection_Detail,$request->transection_type,$request->transection_date,$request->transection_amount);

        //บันทึกข้อมูล สร้าง Object
        $transections = new transections;
        //detail=fild transection_Detail=input
        $transections->detail = $request->transection_Detail;
        $transections->type = $request->transection_type;
        $transections->date = $request->transection_date;
        $transections->amount = $request->transection_amount;
        $transections->save();
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }
    public function edit($id){
        //dd($id);
        $transections = transections::find($id);
        //dd($transections,$transections->detail);
        return view('admin.edit',compact('transections'));
    }
    public function update(Request $request , $id){
        $request->validate(
            [
                
                'transection_Detail'=>"required|max:255",
                'transection_type'=>"required|in:in,out",
                'transection_date'=>"required",
                'transection_amount' => "required|regex:/^\d+(\.\d{1,2})?$/"
            ],
            [
                'transection_Detail.required'=>"กรุณาป้อนข้อมูลแผนก",
                'transection_type.required'=>"กรุณาเลือก รายรับหรือรายจ่าย",
                'transection_Detail.mex'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
                'transection_date.required'=>"กรุณาเลือกหรือกรอก วันที่",
                'transection_amount.required'=>"กรุณาป้อนจำนวน",
                'transection_amount.regex'=>"รูปแบบจำนวนธุรกรรมไม่ถูกต้อง"
            ]
            );
        //dd($id , $request->transection_Detail,$request->transection_type,$request->transection_date,$request->transection_amount);
        transections::find($id)->update([
            $update = 'detail'=>$request->transection_Detail,
            'type'=>$request->transection_type,
            'date'=>$request->transection_date,
            'amount'=>$request->transection_amount
        ]);
        return redirect()->route('admin')->with('success',"อัพเดตข้อมูลเรียบร้อย");

    }
    public function delete($id){
        //dd($id);
        $delete=transections::find($id)->forceDelete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }
}
