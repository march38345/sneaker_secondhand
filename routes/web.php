<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\MessageController;
use App\Models\Statement;
use App\Models\Provinces;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'home'])->middleware('check_status')->name('homepage');
Route::get('/market', [HomeController::class,'getmarket'])->middleware('check_status')->name('market');

Auth::routes();


Route::get('/home', [HomeController::class,'home'] )->middleware('check_status')->name('home');
Route::get('/admin/home',[HomeController::class,'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/set_for_sale',[SaleController::class,'set_for_sale'])->name('set_for_sale')->middleware('check_status');
Route::post('/set_for_sale/confirm',[SaleController::class,'confirmsale'])->name('confirmsale')->middleware('check_status');
Route::get('/detail_product/{id_product}',function ($id_product)
{   
    $product = Statement::where('id',$id_product)->get();
    
    $count = 0; 
    foreach($product as $item){
       $str = $item->path_img;
       $ar = explode(",",$str);
       $product[$count]->path_img = $ar; 
       $count++;

    }
   
    
   return view('detail_product.product')->with(compact('product'));
})->middleware('check_status');
Route::post('/dropdowndesttrict',[SaleController::class,'district'])->name('dropdowndistrict');
Route::get('/profile/{id}',function($id) 
{  $info =  Statement::where('user_id',$id)->get();
   $user = User::where('id',$id)->get();
   $count = 0; 
   foreach($info as $item){
      $str = $item->path_img;
      $ar = explode(",",$str);
      $info[$count]->path_img = $ar; 
      $count++;
      

   }
   return view('profile.profile')->with(compact('info','user'));
})->name('profile')->middleware('check_status');

Route::post('/profile/updateprofile',[HomeController::class,'uppro'])->name('updateprofile')->middleware('check_status');
Route::post('/profile/updatestate',[HomeController::class,'upstate'])->name('upstate')->middleware('check_status');
Route::get('/modifyproduct/{id}',function($id) 
{  $info =  Statement::where('id',$id)->get();
   $count = 0; 
   $province = Provinces::get();
     foreach($info as $item){
      $str = $item->path_img;
      $ar = explode(",",$str);
      $info[$count]->path_img = $ar; 
      $count++;
      

   }
  return view('profile.modifyproduct')->with(compact('info','province')); 
})->middleware('check_status');
Route::get('/profile/deleteproduct/{id}',function ($id)
{
   
$product = Statement::where('id',$id)->delete();
if($product){
   return redirect()->back()->with('successdelete','ทำการลบสำเร็จ') ;  
}
else{
   return redirect()->back()->with('errordelete','ทำการลบไม่สำเร็จ');
}

});
Route::get('/admin/addtoadmin/{id}',function ($id)
{  
   $admin = 1;
   $user = User::where('id',$id)->update(['is_admin'=>$admin]);
   return back();

});
Route::get('/admin/delete/{id}',function ($id)
{  
   
   $user = User::where('id',$id)->delete();
   return back();

});
Route::post('/admin/getdata',[HomeController::class,'dataadmin'])->name('dataadmin');
Route::post('/admin/dataproductdate',[HomeController::class,'dataproductdate'])->name('dataproductdate');
Route::get('/admin/profile',[AdminController::class,'profile'])->name('profileadmin');
Route::get('/admin/getcustomer',[AdminController::class,'getcustomer'])->name('getcustomer');
Route::get('/admin/getgrahp',[AdminController::class,'getgrahp'])->name('getgrahp');
Route::get('/admin/getorder',[AdminController::class,'getorder'])->name('getorder');
Route::get('/chat',[MessageController::class,'viewchat'])->name('viewchat');
Route::post('/chat/sendmessage',[MessageController::class,'sendto'])->name('sendto');
Route::post('/message/getlist',[MessageController::class,'getlist'])->name('getlist');
Route::post('/message/getmessage',[MessageController::class,'getmessage'])->name('getmessage');
Route::post('/getproduct',[HomeController::class,'getproduct'])->name('getproduct');