<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function getAllCategory()
    {
        Gate::authorize('updateCategory', CategoryModel::class);
        $categories = Cache::remember('categories', 600,
            fn () => CategoryModel::all());
        return view('category.categoryView', ['categories' => $categories]);
    }

    public function createCategory(request $request)
    {
        Gate::authorize('updateCategory', CategoryModel::class);
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:50'
        ]);
        CategoryModel::create($validated);
        return redirect()->route('categoryView');
    }

    public function getCategoryById(CategoryModel $category)
    {
        Gate::authorize('updateCategory', CategoryModel::class);
        return view('category.editCategory', ['category' => $category]);
    }

    public function editCategory(request $request, CategoryModel $category)
    {
        Gate::authorize('updateCategory', CategoryModel::class);
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:50'
        ]);
        $category->update($validated);
        return redirect()->route('categoryView');
    }

    public function deleteCategory(CategoryModel $category)
    {
        Gate::authorize('updateCategory', CategoryModel::class);
        if ($category->posts()->exists()) {
            return redirect()->back()->with('error', 'Category cannot be deleted because it has posts.');
        } else {
            $category->delete();
            return redirect()->route('categoryView');
        }
    }
}
