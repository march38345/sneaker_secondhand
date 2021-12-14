<?php

namespace App\Http\Controllers;

use App\Models\Statement;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $statement = Statement::all();
        return response()->json($statement);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
       $stement = new Statement;
       $stement->user_id = $request->user_id;
       $stement->name = $request->name;
       $stement->brand_name = $request->brand_name;
       $stement->path_img = $request->path_img;
       $stement->discription = $request->discription ;
       $stement->size = $request->size ;
       $stement->price = $request->price;
       $stement->phone = $request->phone;
       $stement->status = $request->status;
       $stement->province = $request->province;
       $stement->district = $request->district ;
       $connect = $stement->save();
    
        if($connect){   
            return response()->json(["status"=>'success']);
        
        }
        
        return response()->json(["status"=>'false']);


       
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stement =  Statement::where('id',$id)->get();
        return response()->json($stement);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    
        $request->validate(
            ['brand_name'=>'required',
            'discription'=>'required',
            'province'=>'required',
            'district'=>'required',
             'price'      =>'required|max:255',
             'size'      =>'required|max:255',
             'phone'      =>'required|max:255',
            
            
        ]);
          
        if (empty($request->img)) {
            $upstate = Statement::where('id', $id)->update([
                'brand_name' => $request->brand_name,
                'discription' => $request->discription,
                'size' => $request->size,
                'price' => $request->price,
                'phone' => $request->phone,
                'province' => $request->province,
                'district' => $request->district

            ]);
            return response()->json(['status'=>'update success']);
        } else {
            $obj = $request->img;
            $path = "";
            $imgname = "";
            $i = 0;
            $len = count($obj);
            foreach ($obj as $c) {
                $imgname = hexdec(uniqid()) . "." . strtolower($c->getClientOriginalExtension());

                $c->move('image/store/', $imgname); #uploads รูปภาพไปที่public/store/
                #checkตัววสุดท้าย
                if ($i == $len - 1) {
                    $path .= $imgname;
                } else {
                    $path .= $imgname . ",";
                }
                $i++;
                $imgname = "";
            }
            $upstate = Statement::where('id',$id)->update([
                'brand_name' => $request->brand_name,
                'discription' => $request->discription,
                'size' => $request->size,
                'price' => $request->price,
                'phone' => $request->phone,
                'province' => $request->province,
                'district' => $request->district,
                'path_img' => $path

            ]);
            return response()->json(['status'=>'update success']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {$product = Statement::where('id',$id)->delete();
        if($product){
           return  response()->json(['status'=>'update success']);  
        }
        else{
           return response()->json(['status'=>'update error']);
        }
        
    }
}
