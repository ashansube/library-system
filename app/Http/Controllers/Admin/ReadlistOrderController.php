<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Readlistorder;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class ReadlistOrderController extends Controller
{
    public function index(Request $request)
    {
        // $todayDate = Carbon::now();
        // $readlistorders = Readlistorder::whereDate('created_at',$todayDate)->paginate(10);

        $todayDate = Carbon::now()->format('Y-m-d');
        $readlistorders = Readlistorder::when($request->date != null, function ($q) use ($request) {
                                    return $q->whereDate('created_at',$request->date);
                                }, function ($q) use ($todayDate) {
                                    return $q->whereDate('created_at',$todayDate);
                                })
                                ->when($request->status != null, function ($q) use ($request) {
                                    return $q->where('status_message',$request->status);
                                })
                                ->paginate(10);


        return view('admin.readlistorders.index', compact('readlistorders'));
    }

    public function show(int $readlistorderId)
    {
        $readlistorder = Readlistorder::where('id',$readlistorderId)->first();
        if($readlistorder){
            return view('admin.readlistorders.view', compact('readlistorder'));
        }else{
            return redirect('admin/readlistorders')->with('message', 'No Order Found');
        }
    }

    public function updateOrderStatus(int $readlistorderId, Request $request)
    {
        $readlistorder = Readlistorder::where('id',$readlistorderId)->first();
        if($readlistorder){
            $readlistorder->update([
                'status_message' => $request->readlistorder_status
            ]);
            return redirect('admin/readlistorders/'.$readlistorderId)->with('message', 'Order Status Updated');
        }else{
            return redirect('admin/readlistorders/'.$readlistorderId)->with('message', 'No Order Found');
        }
    }

    public function viewInvoice(int $readlistorderId)
    {
        $readlistorder = Readlistorder::findOrFail($readlistorderId);
        return view('admin.readlistinvoice.generate-invoice', compact('readlistorder'));
    }

    public function generateInvoice(int $readlistorderId)
    {
        $readlistorder = Readlistorder::findOrFail($readlistorderId);
        $data = ['readlistorder' => $readlistorder];

        $pdf = Pdf::loadView('admin.readlistinvoice.generate-invoice', $data);

        $todayDate = Carbon::now()->format('Y-m-d');
        return $pdf->download('library-invoice-'.$readlistorder->id.'-'.$todayDate.'.pdf');
    }
}
