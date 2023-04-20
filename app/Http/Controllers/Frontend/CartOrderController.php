<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cartorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartOrderController extends Controller
{
    public function index()
    {
        $cartorders = Cartorder::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(10);
        return view('frontend.cartorders.index', compact('cartorders'));
    }

    public function show($cartorderId)
    {
        $cartorder = Cartorder::where('user_id',Auth::user()->id)->where('id',$cartorderId)->first();
        if($cartorder){
            return view('frontend.cartorders.view', compact('cartorder'));
        }else{
            return redirect()->back()->with('message', 'No Order Found');
        }
    }
}
