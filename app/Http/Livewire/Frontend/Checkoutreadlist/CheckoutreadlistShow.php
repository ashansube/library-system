<?php

namespace App\Http\Livewire\Frontend\Checkoutreadlist;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Readlist;
use Illuminate\Support\Str;
use App\Models\Readlistorder;
use App\Models\Readlistorderitem;

class CheckoutreadlistShow extends Component
{
    public $readlists, $totalShippingAmount = 0, $shippingFee = 350, $serviceCharge = 200, $expectedReturnDate;

    public $fullname, $email, $phone, $postelcode, $address, $payment_mode = NULL, $payment_id = NULL;

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10',
            'postelcode' => 'required|string|max:6|min:5',
            'address' => 'required|string|max:500',
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        $currentDate = Carbon::now();
        $expectedReturnDate = $currentDate->addDays(14);
        $this->expectedReturnDate = $expectedReturnDate->format('Y-m-d');

        $readlistorder = Readlistorder::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'book-'.Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'postelcode' => $this->postelcode,
            'address' => $this->address,
            'status_message' => 'In Progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
            'expected_return_date' => $this->expectedReturnDate
        ]);

        foreach ($this->readlists as $readlistItem) {
            $readlistorderItems = Readlistorderitem::create([
                'order_id' => $readlistorder->id,
                'book_id' => $readlistItem->book_id,
                'quantity' => $readlistItem->quantity,
            ]);

            $readlistItem->book()->where('id',$readlistItem->book_id)->decrement('quantity',$readlistItem->quantity);
        }

        return $readlistorder;
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder){
            Readlist::where('user_id', auth()->user()->id)->delete();

            session()->flash('message', 'Order Placed Successfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    public function totalShippingAmount()
    {
        $this->totalShippingAmount = 0;
        $this->shippingFee = 350;
        $this->serviceCharge = 200;
        $this->readlists = Readlist::where('user_id', auth()->user()->id)->get();

        return $this->totalShippingAmount = $this->shippingFee + $this->serviceCharge;
    }

    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->totalShippingAmount = $this->totalShippingAmount();
        return view('livewire.frontend.checkoutreadlist.checkoutreadlist-show', [
            'totalShippingAmount' => $this->totalShippingAmount
        ]);
    }
}
