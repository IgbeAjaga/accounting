<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CustomersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Return the collection of products with only the fields we need
        return Customer::select('id', 'account_number', 'name', 'email', 'phone', 'old_balance', 'new_balance', 'created_at')->get();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Account Number',
            'Name',
            'Email',
            'Phone',
            'Old Balance',
            'New Balance',        
            'Date',
        ];
    }
}
