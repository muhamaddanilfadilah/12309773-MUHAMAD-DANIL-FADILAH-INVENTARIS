<?php

namespace App\Exports;

use App\Models\Lending;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LendingExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Lending::with(['item', 'editor'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Item Name',
            'Total Dipinjam',
            'Repair',
            'Borrower Name',
            'Keterangan',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Editor'
        ];
    }

    public function map($lending): array
    {
        static $no = 1;

        $repair = ($lending->item && $lending->item->repair == 0)
            ? '-'
            : ($lending->item->repair ?? '-');

        $tanggalPinjam = $lending->date
            ? date('d-m-Y', strtotime($lending->date))
            : '-';

        $tanggalKembali = $lending->returned_at
            ? date('d-m-Y', strtotime($lending->returned_at))
            : '-';

        $editor = $lending->editor->name ?? '-';

        return [
            $no++,
            $lending->item->name ?? '-',
            $lending->total,
            $repair,
            $lending->name,
            $lending->keterangan ?? '-',
            $tanggalPinjam,
            $tanggalKembali,
            $editor
        ];
    }
}