<?php

namespace App\Http\Livewire\Frontend\Book;

use Livewire\Component;

class Index extends Component
{
    public $books, $category;

    public function mount($books, $category)
    {
        $this->books = $books;
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.frontend.book.index', [
            'books' => $this->books,
            'category' => $this->category
        ]);
    }
}
