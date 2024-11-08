<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Readlistorderitem extends Model
{
    use HasFactory;

    protected $table = 'readlistorder_items';

    protected $fillable = [
        'order_id',
        'book_id',
        'quantity'
    ];

    /**
     * Get the book that owns the Readlistorderitem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
