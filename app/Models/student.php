<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'age',
        'status',
    ];

    // public function images(): HasOne
    // {
    //     return $this->hasOne(Image::class,'id','image_id');
    // }
}
