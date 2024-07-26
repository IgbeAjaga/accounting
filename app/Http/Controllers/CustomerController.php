<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerUpdateRequest;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(1000);
          
        return view('allcustomers', compact('customers'))
                    ->with('i', (request()->input('page', 1) - 1) * 1000);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // If you need to show a form to create a new customer, you can return a view here.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // If you need to store a new customer, handle the logic here.
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('showcustomer',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('editcustomer',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
          
        return redirect()->route('allcustomers')
                        ->with('success','Report updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
           
        return redirect()->route('allcustomers')
                        ->with('success','Customer deleted successfully');
    }

    public function createCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:255',
        ]);

        $accountNumber = rand(10000, 99999);

        $customer = Customer::create([
            'account_number' => $accountNumber,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'old_balance' => 0.00,
            'new_balance' => 0.00,
        ]);

        return redirect()->back()->with('success', 'Account created successfully with account number ' . $accountNumber);
    }

    public function processTransaction(Request $request)
{
    $request->validate([
        'account_number' => 'required|string|exists:customers,account_number',
        'amount' => 'required_without:kg|numeric|min:0',
        'kg' => 'required_without:amount|numeric|min:0',
    ]);

    $customer = Customer::where('account_number', $request->account_number)->firstOrFail();
    $customer->old_balance = $customer->new_balance;

    if ($request->has('amount')) {
        if ($request->amount < 0) {
            return redirect()->back()->with('error', 'Amounts below zero cannot be credited.');
        }
        $customer->new_balance += $request->amount;
        $transactionType = 'credit';
        $amount = $request->amount;
        $quantity = 0.00; // Use 0.00 as placeholder for credit transactions
    } elseif ($request->has('kg')) {
        $amount = $request->kg * 80;
        if ($amount > $customer->new_balance) {
            return redirect()->back()->with('error', 'Insufficient balance, please credit your account.');
        }
        $customer->new_balance -= $amount;
        $transactionType = 'debit';
        $quantity = $request->kg;
    }

    $customer->save();

    Transaction::create([
        'account_number' => $customer->account_number,
        'amount' => $amount,
        'transactiontype' => $transactionType,
        'old_balance' => $customer->old_balance,
        'new_balance' => $customer->new_balance,
        'quantity' => $quantity,
    ]);

    return redirect()->back()->with('success', 'Transaction processed successfully.');
}

    

    /**
     * Search the products based on various criteria.
     */
    public function search(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('account_number')) {
            $query->where('account_number', 'like', '%' . $request->account_number . '%');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', $request->phone);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $customers = $query->paginate(10);

        return view('searchcustomer', compact('customers'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
}
