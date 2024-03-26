<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBuy extends Model
{
    protected $table = 'productbuy';
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'quantity',
       
    ];
    use HasFactory;

}
