<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Client::select('id', 'name', 'email', 'company', 'phone','address', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Company',
            'Phone',
            'address',
            'Created At',
        ];
    }
}
