<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    /**
     * Get the book that owns the Cartorderitem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

}
