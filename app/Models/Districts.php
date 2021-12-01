<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $fillable=[
        'id',
        'code',
        'name_in_thai',
        'name_in_english',
        'province_id'
   

    ];
}
