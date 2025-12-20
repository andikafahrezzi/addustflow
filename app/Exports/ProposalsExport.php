<?php

namespace App\Exports;

use App\Models\Proposal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProposalsExport implements FromCollection, WithHeadings
{
    /**
     * Ambil semua data proposal
     */
    public function collection()
    {
        return Proposal::with('lead')
            ->get()
            ->map(function($proposal){
                return [
                    'ID' => $proposal->id,
                    'Lead' => $proposal->lead->title ?? 'N/A',
                    'Title' => $proposal->title,
                    'Description' => $proposal->description,
                    'Estimated Value' => $proposal->estimated_value,
                    'Status' => $proposal->status,
                    'Created At' => $proposal->created_at->format('Y-m-d H:i:s'),
                    'Updated At' => $proposal->updated_at->format('Y-m-d H:i:s'),
                ];
            });
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'ID',
            'Lead',
            'Title',
            'Description',
            'Estimated Value',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
}
