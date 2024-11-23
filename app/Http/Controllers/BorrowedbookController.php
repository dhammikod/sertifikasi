<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\member;
use App\Models\book;
use App\Models\borrow;

class BorrowedbookController
{
    public function borrows(){
        $member = member::all();
        $books = Book::whereDoesntHave('borrows', function ($query) {
            $query->whereNull('tanggal_kembali'); // Exclude books that haven't been returned
        })->get();
        
        return view('/memberborrows/borrows',[
            'titlepage' => "Borrow page",
            'members' => $member,
            'books' => $books
        ]);
    }

    public function create_borrows(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'member_id' => 'required|exists:member,id', 
            'books' => 'required|array|min:1',
            'books.*' => 'exists:books,id',
        ]);

        $member_id = $validated['member_id'];
        $book_ids = $validated['books'];

        // Record each borrow in the borrows table
        foreach ($book_ids as $book_id) {
            Borrow::create([
                'member_id' => $member_id,
                'book_id' => $book_id,
                'tanggal_pinjam' => now(),
                'tanggal_kembali' => null,
            ]);
        }

        return redirect("borrow");
    }

    public function manage_borrows(){
        $members = member::all();
        $books = Book::whereDoesntHave('borrows', function ($query) {
            $query->whereNull('tanggal_kembali'); // Exclude books that haven't been returned
        })->get();

        return view('Memberborrows/manage_borrows',[
            'titlepage' => 'manage borrowed book',
            'members' => $members,
            'books' => $books,
        ]);
    }

    public function getBorrowedBooks($id)
    {
        $borrows = Borrow::where('member_id', $id)
            ->with('book')
            ->get();

        return response()->json($borrows);
    }

    public function markBookAsReturned(Request $request)
    {
        $validated = $request->validate([
            'borrow_id' => 'required|exists:borrows,id', // Ensure the borrow record exists
        ]);

        $borrow = Borrow::findOrFail($validated['borrow_id']);
        $borrow->tanggal_kembali = now(); // Mark as returned by setting the current date and time
        $borrow->save();

        return redirect("/manage_borrow");
    }
}
