<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Exports\ItemExport;
use Maatwebsite\Excel\Facades\Excel;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $items = Item::with('category')
        ->withSum(['lendings as lendings_sum_total' => function ($query) {
            $query->whereNull('returned_at');
        }], 'total')
        ->get()
        ->map(function ($item) {
            $item->available = $item->total 
                - $item->repair 
                - ($item->lendings_sum_total ?? 0);

            return $item;
        });

    return view('items.index', compact('items'));
}

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'total' => 'required|integer|min:0',
        ]);
        $validated['repair'] = 0;
        $validated['available'] = $validated['total'];

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function show(Item $item)
    {
        //
    }

    public function edit(Item $item)
    {
        $categories = \App\Models\Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'total' => 'required|integer|min:0',
            'new_broken_item' => 'required|integer|min:0',
        ]);

        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->total = $request->total;

        if ($request->new_broken_item > 0) {
            $item->repair += $request->new_broken_item;
        }

        $item->available = $item->total - $item->repair;

        $item->save();

        return redirect()->route('items.index')->with('success', 'Data barang berhasil diperbarui');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus');
    }

public function export()
{
    $filename = "item_export_" . date('Y_m_d_H_i_s') . ".xlsx";
    return Excel::download(new ItemExport, $filename);
}
}
