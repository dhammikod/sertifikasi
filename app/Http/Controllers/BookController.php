<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\book;
use App\Models\Categories;


class BookController
{
    public function book(Request $request)
    {
        // Get all categories for the filter dropdown
        $categories = Categories::all();

        // Initialize query for books
        $query = Book::with('categories');

        //filter by category if user fill category
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        // Execute query and get filtered books
        $books = $query->get();

        return view('books/books', [
            'titlepage' => 'Books',
            'Books' => $books,
            'Categories' => $categories,
        ]);
    }


    public function create_books(){
        $validated = request()->validate([
            'book_title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
        ]);

        $book = Book::create([
            'book_title' => $validated['book_title'],
            'author' => $validated['author_name'],
        ]);

        //creating book-category table using attach
        if (isset($validated['categories'])) {
            $book->categories()->attach($validated['categories']);
        }

        return redirect('/books');
    }

    public function edit_book(){
        $book_id = "";
        $Categories = Categories::all();

        if (isset($_POST['book_id'])){
            $book_id = request('book_id');
        }

        $book = book::find($book_id);
        #check if this functino is accesed by navigating from authorpage or not
        if(isset($_POST["edit_done"])){
            $book->book_title = $_POST['book_title'];
            $book->author = $_POST['author_name'];

            $book->save();

            // Update the categories associated with the book
            if (isset($_POST['categories']) && is_array($_POST['categories'])) {
                $book->categories()->sync($_POST['categories']);
            } else {
                $book->categories()->detach();
            }

            return redirect('/books');
        }else{
            return view('books/edit_books',[
                'titlepage' => "Edit Books",
                'book' => $book,
                'Categories' => $Categories
            ]);
        }
    }

    public function delete_book(){
        $validated = request()->validate([
            'book_id' => 'required|exists:books,id', // Ensure the book exists
        ]);
    
        $book = Book::find($validated['book_id']);
    
        //deleting book-category table using detach
        $book->categories()->detach();
        $book->delete();
        
        return redirect('/books');
    }
}
