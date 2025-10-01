<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TransactionController extends Controller
{
    // GET /api/transactions
    public function index(Request $request)
    {
        $query = Auth::user()
            ->transactions()
            ->with('category')
            ->orderBy('date', 'desc');


        if ($request->has('limit')) {
            $limit = (int) $request->query('limit');
            $transactions = $query->take($limit)->get();
        } else {
            $transactions = $query->get();
        }

        return response()->json([
            'success' => true,
            'count' => $transactions->count(),
            'transactions' => $transactions
        ]);
    }


    // POST /api/transactions
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'date' => 'required|Date',
            'description' => 'nullable|string',
            'category_name' => 'required|string',
        ]);

        $user = Auth::user();

        // Chercher ou créer la catégorie
        $category = Category::firstOrCreate(
            [
                'name' => $request->category_name,
                'user_id' => $user->id
            ],
            [
                'type' => $request->type
            ]
        );

        // Créer la transaction
        $transaction = $user->transactions()->create([
            'category_id' => $category->id,
            'title' => $request->title,
            'amount' => $request->amount,
            'type' => $request->type,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        // 🔹 Mettre à jour le budget
        if ($transaction->type === 'income') {
            $user->addToBudget($transaction->amount);
        } else {
            $user->subtractFromBudget($transaction->amount);
        }

        return response()->json([
            'success' => true,
            'transaction' => $transaction,
            'new_budget' => $user->budget
        ], 201);
    }

    // PUT /api/transactions/{id}
    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'sometimes|string',
            'amount' => 'sometimes|numeric',
            'type' => 'sometimes|in:income,expense',
            'date' => 'sometimes|date',
            'description' => 'nullable|string',
            'category_name' => 'sometimes|string',
        ]);

        $user = Auth::user();

        // 🔹 Annuler l’ancien effet
        if ($transaction->type === 'income') {
            $user->subtractFromBudget($transaction->amount);
        } else {
            $user->addToBudget($transaction->amount);
        }

        // Mettre à jour la catégorie si elle a changé
        if ($request->has('category_name')) {
            $category = Category::firstOrCreate(
                [
                    'name' => $request->category_name,
                    'user_id' => $user->id
                ],
                [
                    'type' => $request->type ?? $transaction->type
                ]
            );
            $transaction->category_id = $category->id;
        }

        // Mise à jour de la transaction
        $transaction->update($request->all());

        // 🔹 Appliquer le nouvel effet
        if ($transaction->type === 'income') {
            $user->addToBudget($transaction->amount);
        } else {
            $user->subtractFromBudget($transaction->amount);
        }

        return response()->json([
            'success' => true,
            'transaction' => $transaction,
            'new_budget' => $user->budget
        ]);
    }

    // DELETE /api/transactions/{id}
    public function destroy(Transaction $transaction) 
    {
        if ($transaction->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user = Auth::user();

        // 🔹 Annuler l'effet de la transaction supprimée
        if ($transaction->type === 'income') {
            $user->subtractFromBudget($transaction->amount);
        } else {
            $user->addToBudget($transaction->amount);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction supprimée et budget recalculé',
            'new_budget' => $user->budget
        ]);
    }
}
