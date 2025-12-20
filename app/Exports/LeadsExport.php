<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Lead::with('client', 'creator')->get()->map(function($lead) {
            return [
                'Client'      => $lead->client->name ?? '',
                'Title'       => $lead->title,
                'source'      => $lead->source,
                'Notes'       => $lead->notes,
                'Status'      => ucfirst($lead->status),
                'Created By'  => $lead->creator->name ?? '',
                'Created At'  => $lead->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return ['Client', 'Title','source', 'Notes', 'Status', 'Created By', 'Created At'];
    }
}
