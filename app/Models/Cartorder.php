<?php

namespace App\Models;

use App\Models\Cartorderitem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    /**
     * Get all of the cart order for the Cartorder
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartorderItems(): HasMany
    {
        return $this->hasMany(Cartorderitem::class, 'order_id', 'id');
    }
}
