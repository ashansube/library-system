<?php

namespace App\Http\Livewire\Frontend\Book;

use App\Models\Cart;
use App\Models\Readlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $book, $quantityCount = 1;

    public function decrementQuantity()
    {
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }

    public function incrementQuantity()
    {
        if($this->quantityCount < 5){
            $this->quantityCount++;
        }
    }

    public function addToCart(int $bookId)
    {
        if(Auth::check())
        {
            // dd($bookId);
            if($this->book->where('id', $bookId)->where('status', '0')->exists())
            {
                // dd('am book');
                if(Cart::where('user_id',auth()->user()->id)->where('book_id',$bookId)->exists())
                {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Book Already in the Cart',
                        'type' => 'warning',
                        'status' => 200
                    ]);
                }
                else
                {
                    if($this->book->quantity > 0)
                    {
                        if($this->book->quantity > $this->quantityCount)
                        {
                            // Insert Book to Cart
                            Cart::create([
                                'user_id' => auth()->user()->id,
                                'book_id' => $bookId,
                                'quantity' => $this->quantityCount
                            ]);
                            $this->emit('CartAddedUpdated');
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Book Added to Cart',
                                'type' => 'success',
                                'status' => 200
                            ]);
                        }
                        else
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Only '.$this->book->quantity.' Quantity Available',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }
                    else
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Out of Stock',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                }
            }
            else
            {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Book Does Not Exists',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        }
        else
        {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to Add to Cart',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    public function addToReadlist(int $bookId)
    {
        if(Auth::check())
        {
            // dd($bookId);
            if($this->book->where('id', $bookId)->where('status', '0')->exists())
            {
                // dd('am book');
                if(Readlist::where('user_id',auth()->user()->id)->where('book_id',$bookId)->exists())
                {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Book Already in the Readlist',
                        'type' => 'warning',
                        'status' => 200
                    ]);
                }
                else
                {
                    if($this->book->quantity > 0)
                    {
                        if($this->book->quantity > $this->quantityCount)
                        {
                            // Insert Book to Readlist
                            Readlist::create([
                                'user_id' => auth()->user()->id,
                                'book_id' => $bookId,
                                'quantity' => $this->quantityCount
                            ]);
                            $this->emit('ReadlistAddedUpdated');
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Book Added to Readlist',
                                'type' => 'success',
                                'status' => 200
                            ]);
                        }
                        else
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Only '.$this->book->quantity.' Quantity Available',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }
                    else
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Out of Stock',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                }
            }
            else
            {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Book Does Not Exists',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        }
        else
        {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to Add to Readlist',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    public function mount($category, $book)
    {
        $this->category = $category;
        $this->book = $book;
    }

    public function render()
    {
        return view('livewire.frontend.book.view', [
            'category' => $this->category,
            'book' => $this->book,
        ]);
    }
}
