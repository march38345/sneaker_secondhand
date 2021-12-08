<?php

namespace App\Http\Controllers;

use App\Models\Statement;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * 
     */


    public function index()
    {
        return view('home');
    }

    public function uppro(Request $request)
    {
        $id = auth()->user()->id;
        $ob = $request->img;
        $path = "";


        $path .= hexdec(uniqid()) . "." . strtolower($ob->getClientOriginalExtension());

        $ob->move('image/img_profile/', $path);



        #dd($request);


        #   dd($request);
        $status = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'img_profile' => $path
        ]);
        return redirect()->back();
    }
    public function dataadmin(Request $request)
    {
        $product = Statement::all();
        $result = array();

        $data = ['Nike' => 0, 'Adidas' => 0, 'Converse' => 0, 'Onitsuka_Tiger' => 0, 'Keds' => 0, 'Reebok' => 0, 'Lacoste' => 0, 'Puma' => 0, 'Vans' => 0, 'other' => 0];
        foreach ($product as $item) {
            $data[$item->brand_name] += 1;
        }


        echo json_encode($data);
    }
    public function upstate(Request $request)
    {

        if (empty($request->img)) {
            $upstate = Statement::where('id', $request->id)->update([
                'brand_name' => $request->brand_name,
                'description' => $request->description,
                'size' => $request->size,
                'price' => $request->price,
                'phone' => $request->phone,
                'province' => $request->province,
                'district' => $request->district

            ]);
            return redirect()->back()->with('sucess', 'แก้ไขสำเร็จ');
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
            $upstate = Statement::where('id', $request->id)->update([
                'brand_name' => $request->brand_name,
                'description' => $request->description,
                'size' => $request->size,
                'price' => $request->price,
                'phone' => $request->phone,
                'province' => $request->province,
                'district' => $request->district,
                'path_img' => $path

            ]);
            return redirect()->back()->with('sucess', 'แก้ไขสำเร็จ');
        }
    }
    public function adminHome()
    {
        $state = Statement::all();
        $user = User::get();

        return view('adminHome')->with(compact('state', 'user'));
    }
    public function getmarket()
    {
        $state_infosale = Statement::all();
        $count = 0;
        foreach ($state_infosale as $item) {
            $str = $item->path_img;
            $ar = explode(",", $str);
            $state_infosale[$count]->path_img = $ar;
            $count++;
        }




        return view('homepage')->with(compact('state_infosale'));
    }


    public function dataproductdate(Request $request)
    {
        $product =   Statement::all();
        $monts = array();
        foreach ($product as $item) {
            $d = $item->created_at;
            array_push($monts, date("m", strtotime($d)));
        }

        echo json_encode($monts);
    }
    public function getproduct(Request $request)
    {

        $re = $request->get('data');
        $brand_name = $re['brand_name'];
        $all = 'all';
        if($brand_name == $all){
            $listproduct = User::join('statements', 'statements.id', '=', 'users.id')
            ->get();

        return response()->json($listproduct);
        }
        $listproduct = User::join('statements', 'statements.id', '=', 'users.id')
            ->where('brand_name', $brand_name)->get();

        return response()->json($listproduct);
    }
    public function home(){
        return view('home');
    }
}
