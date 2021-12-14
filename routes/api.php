<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>['auth:sanctum']], function () {
   Route::apiResource('order',ApiController::class);
});
Route::post('login',function(Request $request){
    
  if(auth()->attempt(array('email'=>$request->email,'password'=>$request->password))){
    $user = User::where('email',$request->email)->first();
    $user->tokens()->delete();
    $token =  $user->createToken($user->name);   
    return response()->json(['token'=>$token->plainTextToken]);
        
    }else{
        abort(401);
    }

  
});
//Route::apiResource('order',ApiController::class);
 