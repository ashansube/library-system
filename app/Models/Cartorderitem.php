<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartorderitem extends Model
{
    use HasFactory;

    protected $table = 'cartorder_items';

    protected $fillable = [
        'order_id',
        'book_id',
        'quantity',
        'price'
    ];
}
