<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Category;
use App\Models\BookImage;
use App\Models\Publisher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\BookFormRequest;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('admin.books.create', compact('categories', 'publishers'));
    }

    public function store(BookFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);

        $book = $category->books()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'author' => $validatedData['author'],
            'slug' => Str::slug($validatedData['slug']),
            'publisher' => $validatedData['publisher'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1':'0',
            'status' => $request->status == true ? '1':'0',
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/books/';

            $i = 1;
            foreach($request->file('image') as $imageFile){
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extention;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;

                $book->bookImages()->create([
                    'book_id' => $book->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }
        return redirect('/admin/books')->with('message', 'Book Added Successfully');
    }

    public function edit(int $book_id)
    {
        $categories = Category::all();
        $publishers = Publisher::all();
        $book = Book::findOrFail($book_id);
        return view('admin.books.edit', compact('categories', 'publishers', 'book'));
    }

    public function update(BookFormRequest $request, int $book_id)
    {
        $validatedData = $request->validated();

        // $book = Category::findOrFail($validatedData['category_id'])
        //             ->books()->where('id', $book_id)->first();

        // Find the book by its ID
        $book = Book::findOrFail($book_id);

        // Find the category by its ID
        $category = Category::findOrFail($validatedData['category_id']);

        if($book)
        {
            $book->update([
                //'category_id' => $validatedData['category_id'],
                'category_id' => $category->id,
                'name' => $validatedData['name'],
                'author' => $validatedData['author'],
                'slug' => Str::slug($validatedData['slug']),
                'publisher' => $validatedData['publisher'],
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $request->trending == true ? '1':'0',
                'status' => $request->status == true ? '1':'0',
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            if($request->hasFile('image')){
                $uploadPath = 'uploads/books/';

                $i = 1;
                foreach($request->file('image') as $imageFile){
                    $extention = $imageFile->getClientOriginalExtension();
                    $filename = time().$i++.'.'.$extention;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath.$filename;

                    $book->bookImages()->create([
                        'book_id' => $book->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }
            return redirect('/admin/books')->with('message', 'Book Updated Successfully');
        }
        else
        {
            return redirect('admin/books')->with('message', 'No Such Book Id Found');
        }
    }

    public function destroyImage(int $book_image_id)
    {
        $bookImage = BookImage::findOrFail($book_image_id);
        if(File::exists($bookImage->image)){
            File::delete($bookImage->image);
        }
        $bookImage->delete();
        return redirect()->back()->with('message', 'Book Image Deleted');
    }

    public function destroy(int $book_id)
    {
        $book = Book::findOrFail($book_id);
        if($book->bookImages){
            foreach($book->bookImages as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }
        $book->delete();
        return redirect('admin/books')->with('message', 'Book Deleted Successfully');
    }
}
