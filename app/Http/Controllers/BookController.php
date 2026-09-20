<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = [
            'Pemrograman PHP (Asep PHP, 2016)',
            'Laravel untuk Pemula (Asep Laravel, 2017)',
            'Basis Data (Asep Data, 2018)',
            'Algoritma dan Pemrograman (Asep Algoritma, 2015)',
            'Pemrograman Berorientasi Objek (Asep Objek, 2022)'
        ];
        $stock = 5;

        return view ('books.index', compact('books', 'stock'));
    }

    public function show($id)
    {
        return 'ID Buku: ' . $id;
    }

    
}
