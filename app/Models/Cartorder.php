<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartorder extends Model
{
    use HasFactory;

    protected $table = 'cartorders';

    protected $fillable = [
        'user_id',
        'tracking_no',
        'fullname',
        'email',
        'phone',
        'postelcode',
        'address',
        'status_message',
        'payment_mode',
        'payment_id'
    ];
}
