
@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h2>Tambah Buku</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div>
            <label>Judul Buku</label>
            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
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
                value="{{ old('author') }}"
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
                value="{{ old('year') }}"
            >

            @error('year')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>Stok Buku</label>
            <input
                type="number"
                name="stock"
                value="{{ old('stock') }}"
            >

            @error('stock')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">Simpan Buku</button>

        <a href="{{ route('books.index') }}">Kembali</a>
    </form>
@endsection
