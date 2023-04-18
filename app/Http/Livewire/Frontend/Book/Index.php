<?php

namespace App\Http\Livewire\Frontend\Book;

use App\Models\Book;
use Livewire\Component;

class Index extends Component
{
    public $books, $category, $publisherInputs = [];

    protected $queryString = [
        'publisherInputs' => ['except' => '', 'as' => 'publisher'],
    ];

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $this->books = Book::where('category_id', $this->category->id)
                        ->when($this->publisherInputs, function($q) {
                            $q->whereIn('publisher', $this->publisherInputs);
                        })
                        ->where('status', '0')
                        ->get();

        return view('livewire.frontend.book.index', [
            'books' => $this->books,
            'category' => $this->category
        ]);
    }
}
