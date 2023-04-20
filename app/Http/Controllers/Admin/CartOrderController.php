<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cartorder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class CartOrderController extends Controller
{
    public function index(Request $request)
    {
        // $todayDate = Carbon::now();
        // $cartorders = Cartorder::whereDate('created_at',$todayDate)->paginate(10);

        $todayDate = Carbon::now()->format('Y-m-d');
        $cartorders = Cartorder::when($request->date != null, function ($q) use ($request) {
                                    return $q->whereDate('created_at',$request->date);
                                }, function ($q) use ($todayDate) {
                                    return $q->whereDate('created_at',$todayDate);
                                })
                                ->when($request->status != null, function ($q) use ($request) {
                                    return $q->where('status_message',$request->status);
                                })
                                ->paginate(10);


        return view('admin.cartorders.index', compact('cartorders'));
    }

    public function show(int $cartorderId)
    {
        $cartorder = Cartorder::where('id',$cartorderId)->first();
        if($cartorder){
            return view('admin.cartorders.view', compact('cartorder'));
        }else{
            return redirect('admin/cartorders')->with('message', 'No Order Found');
        }
    }

    public function updateOrderStatus(int $cartorderId, Request $request)
    {
        $cartorder = Cartorder::where('id',$cartorderId)->first();
        if($cartorder){
            $cartorder->update([
                'status_message' => $request->cartorder_status
            ]);
            return redirect('admin/cartorders/'.$cartorderId)->with('message', 'Order Status Updated');
        }else{
            return redirect('admin/cartorders/'.$cartorderId)->with('message', 'No Order Found');
        }
    }
}
