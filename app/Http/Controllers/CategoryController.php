<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Category::all());
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate(['name' => 'required|string|unique:categories']);
        $category = Category::create($request->all());

        return response()->json(['message' => 'Category created', 'data' => $category], 201);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $request->validate(['name' => 'sometimes|required|string|unique:categories']);
        $category->update($request->all());

        return response()->json(['message' => 'Category updated', 'data' => $category]);
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
