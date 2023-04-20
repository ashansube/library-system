<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Readlistorder;
use Illuminate\Support\Facades\Auth;

class ReadlistOrderController extends Controller
{
    public function index()
    {
        $readlistorders = Readlistorder::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(10);
        return view('frontend.readlistorders.index', compact('readlistorders'));
    }

    public function show($readlistorderId)
    {
        $readlistorder = Readlistorder::where('user_id',Auth::user()->id)->where('id',$readlistorderId)->first();
        if($readlistorder){
            return view('frontend.readlistorders.view', compact('readlistorder'));
        }else{
            return redirect()->back()->with('message', 'No Order Found');
        }
    }
}
