<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        $trendingBooks = Book::where('trending','1')->latest()->take(15)->get();
        return view('frontend.index', compact('sliders', 'trendingBooks'));
    }

    public function newArrival()
    {
        $newArrivalsBooks = Book::latest()->take(16)->get();
        return view('frontend.pages.new-arrival', compact('newArrivalsBooks'));
    }

    public function featuredBooks()
    {
        $featuredBooks = Book::where('featured','1')->latest()->get();
        return view('frontend.pages.featured-books', compact('featuredBooks'));
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

            return view('frontend.collections.books.index', compact('category'));
        }else{
            return redirect()->back();
        }
    }

    public function bookView(string $category_slug, string $book_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        if($category) {

            $book = $category->books()->where('slug', $book_slug)->where('status', '0')->first();
            if($book)
            {
                return view('frontend.collections.books.view', compact('book', 'category'));
            }else{
                return redirect()->back();
            }

        }else{
            return redirect()->back();
        }
    }

    public function thankyou()
    {
        return view('frontend.thank-you');
    }
}
