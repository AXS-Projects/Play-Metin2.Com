<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemShopController extends Controller
{
    public function index()
    {
        // Simulăm itemele dintr-o bază de date
        $items = [
            (object) ['name' => 'Sword of the Moon', 'image' => 'sword.png', 'price' => 500],
            (object) ['name' => 'Dragon Helmet', 'image' => 'helmet.png', 'price' => 350],
            (object) ['name' => 'Phoenix Wings', 'image' => 'wings.png', 'price' => 700],
        ];

        return view('itemshop.index', compact('items'));
    }
}
