<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cartorder;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Readlistorder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalPublishers = Publisher::count();

        $totalAllUsers = User::count();
        $totalUser = User::where('role_as', '0')->count();
        $totalAdmin = User::where('role_as', '1')->count();

        $todayDate = Carbon::now()->format('Y-m-d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalCartOrder = Cartorder::count();
        $todayCartOrder = Cartorder::whereDate('created_at', $todayDate)->count();
        $thisMonthCartOrder = Cartorder::whereMonth('created_at', $thisMonth)->count();
        $thisYearCartOrder = Cartorder::whereYear('created_at', $thisYear)->count();

        $totalReadlistOrder = Readlistorder::count();
        $todayReadlistOrder = Readlistorder::whereDate('created_at', $todayDate)->count();
        $thisMonthReadlistOrder = Readlistorder::whereMonth('created_at', $thisMonth)->count();
        $thisYearReadlistOrder = Readlistorder::whereYear('created_at', $thisYear)->count();

        return view('admin.dashboard', compact('totalBooks', 'totalCategories', 'totalPublishers', 'totalAllUsers', 'totalUser', 'totalAdmin', 'totalCartOrder', 'todayCartOrder', 'thisMonthCartOrder', 'thisYearCartOrder', 'totalReadlistOrder', 'todayReadlistOrder', 'thisMonthReadlistOrder', 'thisYearReadlistOrder'));
    }
}
