<?php

namespace App\Http\Controllers\Api;

use App\Models\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    // GET /api/categories
    public function index()
    {
        return Auth::user()->categories()->get();
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'user_id' => 'required|exists:users,id',
        ]);

        $category = Auth::user()->categories()->create($request->all());

        return response()->json($category, 201);
    }

    // PUT /api/categories/{id}
    public function update(Request $request, category $category)
    {
        if ($category->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $category->update($request->all());

        return response()->json($category);
    }

    // DELETE /api/categories/{id}
    public function destroy(category $category)
    {
        if ($category->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }
}
