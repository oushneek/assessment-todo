<?php

namespace App\Exports;

use App\Models\Todo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TodosExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Todo::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Title',
            'Completed',
            'Created At',
            'Updated At',
        ];
    }
}
