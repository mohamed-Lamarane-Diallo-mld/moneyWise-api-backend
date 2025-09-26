<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class TransactionController extends Controller
{
    // GET /api/transactions
    public function index()
    {
        return JWTAuth::user()
            ->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->get();
    }

    // POST /api/transactions
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $transaction = JWTAuth::user()->transactions()->create($request->all());

        return response()->json($transaction, 201);
    }

    // PUT /api/transactions/{id}
    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== JWTAuth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $transaction->update($request->all());

        return response()->json($transaction);
    }

    // DELETE /api/transactions/{id}
    public function destroy(Transaction $transaction) 
    {
        if ($transaction->user_id !== JWTAuth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted']);
    }
}
