<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lending;
use App\Models\Item;
use App\Exports\LendingExport;
use Maatwebsite\Excel\Facades\Excel;


class LendingController extends Controller
{
    public function index()
    {
        $lendings = Lending::with(['item', 'editor'])->latest()->get();
        return view('lendings.index', compact('lendings'));
    }

    public function create()
    {
        $items = Item::all();
        return view('lendings.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'keterangan' => 'nullable|string',
            'items' => 'required|array',
            'items.*' => 'exists:items,id',
            'totals' => 'required|array',
            'totals.*' => 'integer|min:1',
        ]);

        foreach ($request->items as $index => $item_id) {
            if (isset($request->totals[$index]) && $request->totals[$index] > 0) {
                Lending::create([
                    'name' => $request->name,
                    'item_id' => $item_id,
                    'total' => $request->totals[$index],
                    'keterangan' => $request->keterangan,
                    'date' => $request->date,
                ]);
            }
        }

        return redirect()->route('lendings.index')->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    public function markAsReturned(Lending $lending)
    {
        $lending->update([
            'returned_at' => now(),
            'edited_by' => auth()->id(),
        ]);

        return redirect()->route('lendings.index')->with('success', 'Barang berhasil ditandai sebagai dikembalikan!');
    }

    public function destroy(Lending $lending)
    {
        $lending->delete();
        return redirect()->route('lendings.index')->with('success', 'Data peminjaman berhasil dihapus!');
    }

public function export()
{
    $lendings = Lending::with(['item', 'editor'])->latest()->get();

    // tambahin nomor manual
    foreach ($lendings as $index => $lending) {
        $lending->no = $index + 1;
    }

    $filename = "lending_export_" . date('Y_m_d_H_i_s') . ".xlsx";

    return Excel::download(new LendingExport($lendings), $filename);
}
}