<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromView;

class ListCleanExport implements WithHeadings,FromView
{
    use Exportable;

    public function headings(): array
    {
        return [
            'Phone Numbers',
        ];
    }

    public function __construct(array $array)
    {
        $this->array = $array;
    }
    public function view(): View
    {
        return view('export.list_clean', [
            'array' => $this->array
        ]);
    }
 
}
