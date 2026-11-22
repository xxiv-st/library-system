@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
    <h2>Data Peminjaman</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <a href="{{ route('borrowings.create') }}">Tambah Peminjaman</a>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Anggota</th>
                <th>Petugas</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->id }}</td>
                    <td>{{ $borrowing->member->name }}</td>
                    <td>{{ $borrowing->user->name }}</td>

                    <td>
                        @foreach($borrowing->details as $detail)
                            {{ $detail->book->title }}
                            ({{ $detail->quantity }} buah)
                            <br>
                        @endforeach
                    </td>

                    <td>{{ $borrowing->borrowing_date }}</td>
                    <td>{{ $borrowing->due_date }}</td>
                    <td>{{ $borrowing->return_date ?? '-' }}</td>
                    <td>{{ $borrowing->status }}</td>

                    <td>
                        @if($borrowing->status === 'borrowed')
                            <form action="{{ route('borrowings.return', $borrowing->id) }}"
                                  method="POST">
                                @csrf
                                <button type="submit"
                                    onclick="return confirm('Yakin ingin mengembalikan buku ini?')">
                                    Kembalikan
                                </button>
                            </form>
                        @else
                            Sudah dikembalikan
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Belum ada transaksi peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection