<?php

namespace App\Http\Controllers\Api;

use App\Models\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class CategoryController extends Controller
{
    // GET /api/categories
    public function index()
    {
        return JWTAuth::user()->categories()->get();
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
        ]);

        $category = JWTAuth::user()->categories()->create($request->all());

        return response()->json($category, 201);
    }

    // PUT /api/categories/{id}
    public function update(Request $request, Category $category)
    {
        if ($category->user_id !== JWTAuth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $category->update($request->all());

        return response()->json($category);
    }

    // DELETE /api/categories/{id}
    public function destroy(Category $category)
    {
        if ($category->user_id !== JWTAuth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }
}
