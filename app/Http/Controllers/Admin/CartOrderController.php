<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cartorder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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

    public function viewInvoice(int $cartorderId)
    {
        $cartorder = Cartorder::findOrFail($cartorderId);
        return view('admin.cartinvoice.generate-invoice', compact('cartorder'));
    }

    public function generateInvoice(int $cartorderId)
    {
        $cartorder = Cartorder::findOrFail($cartorderId);
        $data = ['cartorder' => $cartorder];

        $pdf = Pdf::loadView('admin.cartinvoice.generate-invoice', $data);

        $todayDate = Carbon::now()->format('Y-m-d');
        return $pdf->download('bookstall-invoice-'.$cartorder->id.'-'.$todayDate.'.pdf');
    }

    public function mailInvoice(int $cartorderId)
    {
        try {
            $cartorder = Cartorder::findOrFail($cartorderId);

            Mail::to("$cartorder->email")->send(new InvoiceOrderMailable($cartorder));
            return redirect('admin/cartorders/'.$cartorderId)->with('message','Invoice Mail has been sent to '.$cartorder->email);
        } catch (\Exception $e) {
            return redirect('admin/cartorders/'.$cartorderId)->with('message','Something Went Wrong');
        }
    }

}
