
@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h2>Tambah Buku</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div>
            <label>Judul Buku</label>
            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Penulis</label>
            <input
                type="text"
                name="author"
                value="{{ old('author') }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Tahun Terbit</label>
            <input
                type="number"
                name="year"
                value="{{ old('year') }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Stok Buku</label>
            <input
                type="number"
                name="stock"
                value="{{ old('stock') }}"
                min="0"
                required
            >
        </div>

        <br>

        <button type="submit">Simpan Buku</button>

        <a href="{{ route('books.index') }}">Kembali</a>
    </form>
@endsection
