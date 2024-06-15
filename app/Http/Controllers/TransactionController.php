<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::latest()->paginate(5);
          
        return view('alltransactions', compact('transactions'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('showtransaction',compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('edittransaction',compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionUpdateRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
          
        return redirect()->route('alltransactions')
                        ->with('success','Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
           
        return redirect()->route('alltransactions')
                        ->with('success','Transaction deleted successfully');
    }

    public function processTransaction(Request $request) {
        $customer = Customer::where('account_number', $request->account_number)->firstOrFail();
        $customer->old_balance = $customer->new_balance;
        if ($request->has('amount')) {
            // For deposit form
            $customer->new_balance += $request->amount;
            $transactionType = 'credit';
        } elseif ($request->has('kg')) {
            // For purchase form
            $customer->new_balance -= $request->kg * 80;
            $transactionType = 'debit';
        }
        $customer->save();
    
        Transaction::create([
            'account_number' => $customer->account_number,
            'amount' => $request->has('amount') ? $request->amount : $request->kg * 80,
            'transactiontype' => $transactionType,
        ]);
    
        return redirect()->back()->with('success', 'Transaction processed successfully.');
    }

     /**
     * Search the products based on various criteria.
     */
    /**
     * Search transactions based on account number, date from, and date to.
     */
    public function search(Request $request): View
    {
        // Validate request parameters
        $request->validate([
            'account_number' => 'required|string|exists:customers,account_number',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date'
        ]);

        // Fetch customer data
        $customer = Customer::where('account_number', $request->account_number)->firstOrFail();

        // Build query for transactions
        $query = Transaction::where('account_number', $request->account_number)
        ->orderBy('created_at', 'desc');

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Get transactions
        $transactions = $query->paginate(10);

        // Return view with customer data and transactions
        return view('searchtransaction', compact('customer', 'transactions'))->with('i', (request()->input('page', 1) - 1) * 10);
    }



    public function export()
    {
        return Excel::download(new TransactionsExport, 'transactions.xlsx');
    }
}
