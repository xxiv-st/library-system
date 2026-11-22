@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
    <h2>Tambah Peminjaman</h2>

    <a href="{{ route('borrowings.index') }}">Kembali ke daftar peminjaman</a>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf

        <div>
            <label for="member_id">Anggota:</label>
            <select name="member_id" id="member_id" required>
                <option value="">-- Pilih Anggota --</option>

                @foreach($members as $member)
                    <option value="{{ $member->id }}"
                        {{ old('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->name }} ({{ $member->member_code }})
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="book_id">Buku:</label>
            <select name="book_id" id="book_id" required>
                <option value="">-- Pilih Buku --</option>

                @foreach($books as $book)
                    <option value="{{ $book->id }}"
                        {{ old('book_id') == $book->id ? 'selected' : '' }}>
                        {{ $book->title }} (Stok: {{ $book->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="quantity">Jumlah:</label>
            <input
                type="number"
                name="quantity"
                id="quantity"
                min="1"
                value="{{ old('quantity', 1) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="due_date">Tanggal Jatuh Tempo:</label>
            <input
                type="date"
                name="due_date"
                id="due_date"
                min="{{ date('Y-m-d') }}"
                value="{{ old('due_date') }}"
                required
            >
        </div>

        <br>

        <button type="submit">Simpan Peminjaman</button>
    </form>
@endsection