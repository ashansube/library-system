<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Cartorder;
use Illuminate\Support\Str;
use App\Models\Cartorderitem;
use App\Mail\PlaceCartOrderMailable;
use Illuminate\Support\Facades\Mail;

class CheckoutShow extends Component
{
    public $carts, $totalBookAmount = 0, $shippingFee = 350;

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
        $cartorder = Cartorder::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'book-'.Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'postelcode' => $this->postelcode,
            'address' => $this->address,
            'status_message' => 'Pending',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);

        foreach ($this->carts as $cartItem) {
            $cartorderItems = Cartorderitem::create([
                'order_id' => $cartorder->id,
                'book_id' => $cartItem->book_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->book->selling_price,
            ]);

            $cartItem->book()->where('id',$cartItem->book_id)->decrement('quantity',$cartItem->quantity);

        }

        return $cartorder;
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder){
            Cart::where('user_id', auth()->user()->id)->delete();

            try {
                $cartorder = Cartorder::findOrFail($codOrder->id);
                Mail::to("$cartorder->email")->send(new PlaceCartOrderMailable($cartorder));
                // Mail sent successfully
            } catch (\Exception $e) {
                return redirect('checkout')->with('message','Something Went Wrong');
            }

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

    public function totalBookAmount()
    {
        $this->totalBookAmount = 0;
        $this->shippingFee = 350;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as $cartItem) {
            $this->totalBookAmount += $cartItem->book->selling_price * $cartItem->quantity;
        }
        return $this->totalBookAmount += $this->shippingFee;
    }

    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
        $this->postelcode = auth()->user()->UserDetail->postel_code;
        $this->address = auth()->user()->UserDetail->address;

        $this->totalBookAmount = $this->totalBookAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalBookAmount' => $this->totalBookAmount
        ]);
    }
}
