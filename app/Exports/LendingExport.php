<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LendingExport implements FromCollection, WithHeadings
{
    protected $lendings;

    public function __construct($lendings)
    {
        $this->lendings = $lendings;
    }

    public function collection()
    {
        return $this->lendings->map(function ($lending) {
            return [
                'No' => $lending->no,
                'Nama Peminjam' => $lending->name,
                'Barang' => $lending->item->name ?? '-',
                'Total' => $lending->total,
                'Keterangan' => $lending->keterangan ?? '-',

                
                'Tanggal Pinjam' => \Carbon\Carbon::parse($lending->date)->format('d-m-Y H:i:s'),

                'Tanggal Kembali' => $lending->returned_at
                    ? \Carbon\Carbon::parse($lending->returned_at)->format('d-m-Y H:i:s')
                    : '-',

                'Status' => $lending->returned_at ? 'Kembali' : 'Dipinjam',
                'Editor' => $lending->editor->name ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Peminjam',
            'Barang',
            'Total',
            'Keterangan',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Editor'
        ];
    }
}