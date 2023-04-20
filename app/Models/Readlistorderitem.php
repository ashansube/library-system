<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Readlistorderitem extends Model
{
    use HasFactory;

    protected $table = 'readlistorder_items';

    protected $fillable = [
        'order_id',
        'book_id',
        'quantity'
    ];
}
