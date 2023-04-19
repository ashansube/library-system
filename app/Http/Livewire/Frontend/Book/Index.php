<?php

namespace App\Http\Livewire\Frontend\Book;

use App\Models\Book;
use Livewire\Component;

class Index extends Component
{
    public $books, $category, $publisherInputs = [], $priceInput;

    protected $queryString = [
        'publisherInputs' => ['except' => '', 'as' => 'publisher'],
        'priceInput' => ['except' => '', 'as' => 'price'],
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
                        ->when($this->priceInput, function($q) {
                            $q->when($this->priceInput == 'high-to-low', function($q2) {
                                $q2->orderBy('selling_price', 'DESC');
                            })
                            ->when($this->priceInput == 'low-to-high', function($q2) {
                                $q2->orderBy('selling_price', 'ASC');
                            });
                        })
                        ->where('status', '0')
                        ->get();

        return view('livewire.frontend.book.index', [
            'books' => $this->books,
            'category' => $this->category
        ]);
    }
}
