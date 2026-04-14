<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemExport implements FromCollection, WithHeadings, WithMapping
{
    protected $no = 1;

    public function collection()
    {
        return Item::with('category')
            ->withSum(['lendings' => function ($q) {
                $q->whereNull('returned_at');
            }], 'total')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kategori',
            'Nama Barang',
            'Total',
            'Tersedia',
            'Rusak',
            'Dipinjam'
        ];
    }

    public function map($item): array
    {
        return [
            $this->no++,
            $item->category->name ?? '-',
            $item->name,
            $item->total,
            $item->available,
            $item->repair,
            $item->lendings_sum_total ?? 0,
        ];
    }
}