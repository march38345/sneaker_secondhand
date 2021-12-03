<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;
protected $fillable = [
         
        'user_id',
        'name',
        'brand_name', 
        'path_img',
        'discription',
        'size',
        'price',
        'phone',
        'status',
        'province',
        'district'
       
];

    public function user()
    { 
    return $this->hasOne(User::class,'id','user_id');
    }
}
