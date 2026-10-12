
@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <h2>Edit Buku</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Judul Buku</label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $book->title) }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Penulis</label>
            <input
                type="text"
                name="author"
                value="{{ old('author', $book->author) }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Tahun Terbit</label>
            <input
                type="number"
                name="year"
                value="{{ old('year', $book->year) }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Stok Buku</label>
            <input
                type="number"
                name="stock"
                value="{{ old('stock', $book->stock) }}"
                min="0"
                required
            >
        </div>

        <br>

        <button type="submit">Update Buku</button>

        <a href="{{ route('books.index') }}">Batal</a>
    </form>
@endsection
