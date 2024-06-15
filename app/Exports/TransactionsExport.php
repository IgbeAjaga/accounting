<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Return the collection of products with only the fields we need
        return Customer::select('id', 'account_number', 'amount', 'transactiontype', 'created_at')->get();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Account Number',
            'Amount',
            'Transaction Type',                   
            'Date',
        ];
    }
}
