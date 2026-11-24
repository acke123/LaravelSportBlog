<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function getAllCategory()
    {
        $categories = Cache::remember('categories', 600,
            fn () => CategoryModel::all());
        return view('category.categoryView', ['categories' => $categories]);
    }

    public function createCategory(request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:50'
        ]);
        CategoryModel::create($validated);
        return redirect()->route('categoryView');
    }

    public function getCategoryById(CategoryModel $category)
    {
        return view('category.editCategory', ['category' => $category]);
    }

    public function editCategory(request $request, CategoryModel $category)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:50'
        ]);
        $category->update($validated);
        return redirect()->route('categoryView');
    }

    public function deleteCategory(CategoryModel $category)
    {
        $category->delete();
        return redirect()->route('categoryView');
    }
}
