<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Item::with('category')
            ->withSum(['lendings' => function ($query) {
                $query->whereNull('returned_at');
            }], 'total')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Category',
            'Name Item',
            'Total',
            'Repair Total',
            'Last Updated'
        ];
    }

    public function map($item): array
    {
        return [
            $item->category->name ?? '-',
            $item->name,
            $item->total,
            $item->repair == 0 ? '-' : $item->repair,
            $item->updated_at->format('M j, Y'),
        ];
    }
}