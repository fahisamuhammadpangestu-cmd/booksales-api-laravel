<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'book'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar semua transaksi (Admin Access)',
            'data'    => $transactions
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id'  => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $user = Auth::guard('api')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $book = Book::find($request->book_id);

        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok barang tidak cukup. Stok tersisa: ' . $book->stock
            ], 400);
        }

        $orderNumber = 'ORD-' . strtoupper(uniqid());
        $totalAmount = $book->price * $request->quantity;

        // Kurangi stok buku
        $book->stock -= $request->quantity;
        $book->save();

        $transaction = Transaction::create([
            'order_number' => $orderNumber,
            'customer_id'  => $user->id,
            'book_id'      => $request->book_id,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data'    => $transaction->load(['user', 'book'])
        ], 201);
    }

    public function show($id)
    {
        $user = Auth::guard('api')->user();
        $transaction = Transaction::with(['user', 'book'])->find($id);

        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        // Customer hanya boleh melihat transaksinya sendiri
        if ($user->role !== 'admin' && $transaction->customer_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Forbidden Access'], 403);
        }

        return response()->json([
            'success' => true,
            'data'    => $transaction
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        // Contoh update sederhana untuk status atau catatan (sesuai kebutuhan)
        $transaction->update($request->only(['total_amount'])); 

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully',
            'data'    => $transaction
        ], 200);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ], 200);
    }
}