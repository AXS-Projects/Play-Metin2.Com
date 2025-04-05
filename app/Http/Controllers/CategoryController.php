<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class CategoryController extends Controller
{
    public function show($slug)
    {
        // Găsim categoria după slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Obținem itemele care aparțin categoriei
        $items = Item::where('category_id', $category->id)->get();

        // Returnăm view-ul cu datele
        return view('itemshop.category', compact('category', 'items'));
    }
}
