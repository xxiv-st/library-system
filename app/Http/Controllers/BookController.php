<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
         $books = Book::all();

        return view ('books.index', compact('books'));
    }

    public function create() {
        return view('books.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|digits:4|min:1900',
            'stock' => 'required|integer|min:0'
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('Done', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book) {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|digits:4|min:1900',
            'stock' => 'required|integer|min:0'
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('Done', 'Data buku berhasil diperbarui');
    }

    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('books.index');
    }

    public function show($id)
    {
        return 'ID Buku: ' . $id;
    }

    
}
