<?php

namespace App\Http\Controllers;

use App\Models\Statement;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function profile(Request $request)
    {
       echo "profile";
    }
    public function getorder(Request $request)
    {
       $product = Statement::get();
       return view('admin.getorder')->with(compact('product'));
    }
    public function getgrahp(Request $request)
    {
        # code...
    }
    public function getcustomer(Request $request)
    {   $user = User::get();
       return view('admin.getcustomer')->with(compact('user'));
    }
}
