<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }

    public function relatedBooks()
    {
        return $this->hasMany(Book::class, 'category_id', 'id')->latest()->take(8);
    }

    public function publishers()
    {
        return $this->hasMany(Publisher::class, 'category_id', 'id')->where('status', '0');
    }
}
