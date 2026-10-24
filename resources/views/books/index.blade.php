
@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <h2>Daftar Buku</h2>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('books.create') }}">+ Tambah Buku</a>

    <br><br>

    @if ($books->isEmpty())
        <p>Belum ada data buku.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->year }}</td>
                        <td>{{ $book->category?->name ?? 'Belum ada kategori' }}</td>
                        <td>{{ $book->stock }}</td>

                        <td>
                            <a href="{{ route('books.edit', $book->id) }}">
                                Edit
                            </a>

                            <form
                                action="{{ route('books.destroy', $book->id) }}"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Yakin ingin menghapus buku ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
