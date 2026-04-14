<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::where('role', auth()->user()->role)->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Email',
            'Role',
            'Registered At'
        ];
    }

    public function map($user): array
    {
        static $no = 1;

        return [
            $no++,
            $user->name,
            $user->email,
            $user->role,
            $user->created_at->format('d-m-Y')
        ];
    }
}