<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // GET /api/categories
    public function index()
    {
        $categories = Auth::user()->categories()->get();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,NULL,id,user_id,' . Auth::id(),
            'type' => 'required|in:income,expense',
        ]);

        $category = Auth::user()->categories()->create([
            'name' => $request->name,
            'type' => $request->type
        ]);

        return response()->json([
            'success' => true,
            'category' => $category
        ], 201);
    }

    // PUT /api/categories/{id}
    public function update(Request $request, Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id . ',id,user_id,' . Auth::id(),
            'type' => 'required|in:income,expense',
        ]);

        $category->update([
            'name' => $request->name,
            'type' => $request->type
        ]);

        return response()->json([
            'success' => true,
            'category' => $category
        ]);
    }

    // DELETE /api/categories/{id}
    public function destroy(Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted'
        ]);
    }
}
