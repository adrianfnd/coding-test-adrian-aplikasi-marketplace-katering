<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class OrderController extends Controller
{
    public function indexOrder()
    {
        $menus = Menu::with('merchant', 'jenisMakanan')->get();

        return view('order.order', compact('menus'));
    }
}
