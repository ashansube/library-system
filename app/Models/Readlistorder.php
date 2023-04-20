<?php

namespace App\Models;

use App\Models\Readlistorderitem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Readlistorder extends Model
{
    use HasFactory;

    protected $table = 'readlistorders';

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
        'payment_id',
        'expected_return_date'
    ];

    /**
     * Get all of the comments for the Readlistorder
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function readlistorderItems(): HasMany
    {
        return $this->hasMany(Readlistorderitem::class, 'order_id', 'id');
    }
}
