<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Readlist extends Model
{
    use HasFactory;

    protected $table = 'readlists';

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity'
    ];

    /**
     * Get the user that owns the Readlist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
