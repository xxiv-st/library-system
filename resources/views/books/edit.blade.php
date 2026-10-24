
@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <h2>Edit Buku</h2>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Judul Buku</label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $book->title) }}"
            >

            @error('title')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Penulis</label>
            <input
                type="text"
                name="author"
                value="{{ old('author', $book->author) }}"
            >

            @error('author')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Tahun Terbit</label>
            <input
                type="number"
                name="year"
                value="{{ old('year', $book->year) }}"
            >

            @error('year')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>
        <div>
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id">
                <option value="">Pilih Kategori</option>

                @foreach ($categories as $category )
                <option
                    value="{{ $category->id }}"
                    @selected(old('category_id', $book->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
        <br>

        <div>
            <label>Stok Buku</label>
            <input
                type="number"
                name="stock"
                value="{{ old('stock', $book->stock) }}"
            >

            @error('stock')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">Update Buku</button>

        <a href="{{ route('books.index') }}">Batal</a>
    </form>
@endsection
