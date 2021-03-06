<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Provinces;
use App\Models\Statement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOption\Option;

class SaleController extends Controller
{
 public function set_for_sale()
 {   
    $province = Provinces::get();
     return view('set_for_sale')->with(compact('province'));
 }
 public function confirmsale(Request $request)
 {
     
    $request->validate(
        ['description'=>'required',
         'price'      =>'required|max:255',
         'size'      =>'required|max:255',
         'phone'      =>'required|max:255',
        
         'img'        =>'required'
        ],
        [
         'description.required' =>"กรุณากรอกข้อมูลคำอธิบายสินค้า",
         'price.required' =>"กรุณากรอกราคาของสินค้า",
         'size.required' =>"กรุณาระบุไซต์",
         'phone.required' =>"กรุณาระบุเบอร์โทรศัพท์",
         
         'price.max' =>"ห้ามป้อนข้อมูลเกิน255ตัวอักษร",
         'price.max' =>"ห้ามป้อนข้อมูลเกิน255อักษร",
        'img.required'=>"กรุณาอัปโหลดรูปภาพของสินค้าที่ต้องการขาย",
        'img.mimes' => "กรุณาเลือกไฟล์ .jpeg ,.jpg ,.png"

        ]
        
    );
    #จัดการรูปภาพ
    $obj = $request->img;
    $path = "";
    $imgname = "";
    $i = 0;
    $len = count($obj);
    foreach($obj as $c){
        $imgname = hexdec(uniqid()).".".strtolower($c->getClientOriginalExtension());
      
        $c->move('image/store/',$imgname);#uploads รูปภาพไปที่public/store/
        #checkตัววสุดท้าย
        if($i==$len-1){
            $path .= $imgname;
        }else{
            $path .= $imgname.",";
        }
       $i++;
        $imgname = "";
        
    }
    $province = Provinces::get()->where('id',$request->province);
    foreach($province as $item){
         $name_province = $item->name_in_thai;
    }
  
    
    $district = Districts::get()->where('id',$request->district);
    foreach($district as $item){
        $name_district = $item->name_in_thai;
   }

   
    
     
    $statement = new Statement;
    $statement->user_id = Auth::user()->id;
    $statement->name = Auth::user()->name;
    $statement->brand_name = $request->brand_name;
    $statement->path_img =$path;
    $statement->discription = $request->description;
    $statement->size = $request->size;
    $statement->price = $request->price;
    $statement->phone = $request->phone;
    $statement->status = 0;
   $statement->province = $name_province;
    $statement->district = $name_district;


 //
 
    $state =  $statement->save();
    if(!$state){
      return  redirect()->back()->with('error','ตั้งขายไม่สำเร็จ');
    } 
    return  redirect()->back()->with('success','ตั้งการขายสำเร็จ');
 

 
    
    

 }
 public function district(Request $request)
 {
      $district = Districts::get()->where('province_id',$request->select);
   
    $result = array();
      $output = '<option value="">กรุณาเลือกอำเภอ</option>';
     foreach($district as $item){
         
         $output .= '<option value="'.$item->id.'">'.$item->name_in_thai.'</option>';
     }

      echo $output;
      
     
 }
}

