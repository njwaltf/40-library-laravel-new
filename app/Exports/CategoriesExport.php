<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoriesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings() : array
    {
        // Define your headers here
        return [
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
            // Add more headers ,as needed
        ];
    }
    public function collection()
    {
        return Category::all();
    }
}
