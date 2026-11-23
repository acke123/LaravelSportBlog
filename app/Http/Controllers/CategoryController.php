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
        return view('categoryView', ['categories' => $categories]);
    }
}
