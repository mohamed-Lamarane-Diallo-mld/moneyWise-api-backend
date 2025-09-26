<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Tymon\JWTAuth\Facades\JWTAuth;

class StatsController extends Controller
{
    // Dépenses par catégorie
    public function categories()
    {
        $userId = JWTAuth::id();
        $stats = Transaction::where('user_id', $userId)
            ->select('category_id')
            ->selectRaw('SUM(amount) as total')
            ->groupBy('category_id')
            ->with('category') // Relation Category
            ->get();

        return response()->json($stats);
    }

    // Revenus/dépenses par mois
    public function monthly()
    {
        $userId = JWTAuth::id();
        $stats = Transaction::where('user_id', $userId)
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return response()->json($stats);
    }
}
