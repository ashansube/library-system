<?php

namespace App\Http\Livewire\Frontend\Readlist;

use App\Models\Readlist;
use Livewire\Component;

class ReadlistShow extends Component
{
    public $readlist, $shippingFee = 350, $serviceCharge = 200, $counter = 0;

    public function decrementQuantity(int $readlistId)
    {
        $readlistData = Readlist::where('id', $readlistId)->where('user_id', auth()->user()->id)->first();
        if ($readlistData) {
            if ($readlistData->quantity > 1) {
                $readlistData->decrement('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Cannot Be Less Than 1',
                    'type' => 'warning',
                    'status' => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    public function incrementQuantity(int $readlistId)
    {
        $readlistData = Readlist::where('id', $readlistId)->where('user_id', auth()->user()->id)->first();
        if ($readlistData) {
            if ($readlistData->book->quantity > $readlistData->quantity) {
                $readlistData->increment('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Only ' . $readlistData->book->quantity . ' Quantity Available',
                    'type' => 'warning',
                    'status' => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    public function removeReadlistItem(int $readlistId)
    {
        $readlistRemoveData = Readlist::where('user_id', auth()->user()->id)->where('id', $readlistId)->first();
        if ($readlistRemoveData) {
            $readlistRemoveData->delete();

            $this->emit('ReadlistAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Readlist Item Removed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    public function render()
    {
        $this->readlist = Readlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.readlist.readlist-show', [
            'readlist' => $this->readlist
        ]);
    }
}
