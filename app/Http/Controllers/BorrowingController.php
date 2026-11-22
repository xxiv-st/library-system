<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'user', 'details.book'])
            ->latest()
            ->get();

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::orderBy('name')->get();
        $books = Book::where('stock', '>', 0)
            ->orderBy('title')
            ->get();

        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => ['required', 'exists:members,id'],
            'book_id' => ['required', 'exists:books,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'due_date' => ['required', 'date', 'after_or_equal:today'],
        ]);

        DB::transaction(function () use ($validated) {

            $book = Book::whereKey($validated['book_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($book->stock < $validated['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stok buku tidak mencukupi. Stok tersedia: ' . $book->stock,
                ]);
            }

            $borrowing = Borrowing::create([
                'user_id' => Auth::id(),
                'member_id' => $validated['member_id'],
                'borrowing_date' => now()->toDateString(),
                'due_date' => $validated['due_date'],
                'status' => 'borrowed',
            ]);

            BorrowingDetail::create([
                'borrowing_id' => $borrowing->id,
                'book_id' => $book->id,
                'quantity' => $validated['quantity'],
            ]);

            $book->decrement('stock', $validated['quantity']);
        });

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Peminjaman berhasil disimpan.');
    }

    public function returnBook($id)
    {
        DB::transaction(function () use ($id) {

            $borrowing = Borrowing::whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($borrowing->status !== 'borrowed') {
                throw ValidationException::withMessages([
                    'return' => 'Transaksi ini sudah dikembalikan.',
                ]);
            }

            $details = BorrowingDetail::where('borrowing_id', $borrowing->id)
                ->get();

            foreach ($details as $detail) {
                $book = Book::whereKey($detail->book_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $book->increment('stock', $detail->quantity);
            }

            $borrowing->update([
                'status' => 'returned',
                'return_date' => now()->toDateString(),
            ]);
        });

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Buku berhasil dikembalikan dan stok telah diperbarui.');
    }
}