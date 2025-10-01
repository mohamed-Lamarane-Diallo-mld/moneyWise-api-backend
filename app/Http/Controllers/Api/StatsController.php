<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    // Dépenses et revenus par catégorie
    public function categories()
    {
        $userId = Auth::id();
        $transactions = Transaction::where('user_id', $userId)->with('category')->get();

        $stats = [];

        foreach ($transactions as $t) {
            $catName = $t->category ? $t->category->name : 'Sans catégorie';
            if (!isset($stats[$catName])) {
                $stats[$catName] = ['income' => 0, 'expense' => 0];
            }

            if ($t->type === 'income') {
                $stats[$catName]['income'] += $t->amount;
            } else {
                $stats[$catName]['expense'] += $t->amount;
            }
        }

        return response()->json([
            'success' => true,
            'stats_by_category' => $stats
        ]);
    }

    // Revenus/dépenses par mois
    public function monthly()
    {
        $userId = Auth::id();
        $transactions = Transaction::where('user_id', $userId)->get();

        $stats = [];

        foreach ($transactions as $t) {
            $month = $t->date ? substr($t->date, 0, 7) : substr($t->created_at, 0, 7); // format YYYY-MM
            if (!isset($stats[$month])) {
                $stats[$month] = ['income' => 0, 'expense' => 0];
            }
            if ($t->type === 'income') {
                $stats[$month]['income'] += $t->amount;
            } else {
                $stats[$month]['expense'] += $t->amount;
            }
        }

        return response()->json([
            'success' => true,
            'stats_by_month' => $stats
        ]);
    }

    // Résumé global : revenu, dépenses, solde, budget
    public function summary()
    {
        $user = Auth::user();

        $income = $user->transactions()->where('type', 'income')->sum('amount');
        $expense = $user->transactions()->where('type', 'expense')->sum('amount');
        $balance = $income - $expense;

        return response()->json([
            'success' => true,
            'summary' => [
                'total_income'  => $income,
                'total_expense' => $expense,
                'balance'       => $balance,
                'budget'        => $user->budget, // 🔹 mis à jour automatiquement
            ]
        ]);
    }
}
