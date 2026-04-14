<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Lending;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalBorrowed = Lending::where('status', 'dipinjam')->count();
        $totalBroken = Item::where('condition', 'rusak')->count();

        return view('dashboard', compact(
            'totalItems',
            'totalLending',
            'totalAvailable',
        ));
    }
}