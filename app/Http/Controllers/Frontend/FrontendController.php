<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        return view('frontend.index', compact('sliders'));
    }

    public function categories()
    {
        $categories = Category::where('status', '0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function books($category_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        if($category) {

            $books = $category->books()->get();
            return view('frontend.collections.books.index', compact('books', 'category'));
        }else{
            return redirect()->back();
        }
    }
}
