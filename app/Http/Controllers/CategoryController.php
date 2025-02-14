<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        $category = Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
