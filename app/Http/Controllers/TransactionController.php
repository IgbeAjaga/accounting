<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\CartonQty;
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
        $transactions = Transaction::latest()->paginate(10000);
          
        return view('alltransactions', compact('transactions'))
                    ->with('i', (request()->input('page', 1) - 1) * 10000);
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
   

   
    public function processTransaction(Request $request)
    {
        $request->validate([
            'account_number' => 'required|string|exists:customers,account_number',
            'kg' => 'nullable|numeric|min:0',
            'amount' => 'nullable|numeric|min:0',
        ]);

        $customer = Customer::where('account_number', $request->account_number)->firstOrFail();
        $customer->old_balance = $customer->new_balance;

        // Get the latest carton record
        $latestCarton = CartonQty::latest()->first();
        $oldqty = $latestCarton ? $latestCarton->qtybal : 0;
        $oldamount = $latestCarton ? $latestCarton->amountbal : 0;

        if ($request->has('amount')) {
            // For deposit form
            $customer->new_balance += $request->amount;
            $transactionType = 'credit';

            

        } elseif ($request->has('kg')) {
            // For purchase form
            $kg = $request->kg;
            $currentamount = $kg * 80;
            $customer->new_balance -= $currentamount;
            $transactionType = 'debit';

            // Check if there is enough carton available
        if ($kg > $qtybal) {
            return redirect()->back()->with('error', "Insufficient carton! There is $qtybal kg left.");
        }

            // Update carton records
            $CartonQty->qtybal = $oldqty - $kg;
            $CartonQty->amountbal = $oldamount - $currentamount;

        } else {
            return redirect()->back()->with('error', 'Invalid transaction data.');
        }

        $customer->save();

        // Save the carton quantity change
        CartonQty::create([
            'oldqty' => $oldqty,
            'kg' => $kg,
            'qtybal' => $qtybal,
            'oldamount' => $oldamount,
            'currentamount' => $currentamount,
            'amountbal' => $amountbal,
            'transactiontype' => $transactionType,
        ]);

        // Create the transaction record
        Transaction::create([
            'account_number' => $customer->account_number,
            'amount' => $currentamount,
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
