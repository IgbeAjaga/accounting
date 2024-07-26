<?php

namespace App\Http\Controllers;
use App\Models\CartonQty;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Requests\CartonUpdateRequest;

class CartonQtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartons = CartonQty::latest()->paginate(1000);
          
        return view('allcartons', compact('cartons'))
                    ->with('i', (request()->input('page', 1) - 1) * 1000);
    }


    /**
     * Display the specified resource.
     */
    public function show(CartonQty $carton)
    {
        return view('showcarton',compact('carton'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartonQty $carton)
    {
        return view('editcarton',compact('carton'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CartonUpdateRequest $request, CartonQty $carton)
    {
        $carton->update($request->validated());
          
        return redirect()->route('allcartons')
                        ->with('success','Report updated successfully');
    }


     /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartonQty $carton)
    {
        $carton->delete();
           
        return redirect()->route('allcartons')
                        ->with('success','Carton deleted successfully');
    }




    public function addCarton(Request $request)
    {
        $request->validate([
            'kg' => 'required|numeric|min:0',
        ]);

        // Get the latest record for the user
        $latestCarton = CartonQty::latest()->first();

        $oldqty = $latestCarton ? $latestCarton->qtybal : 0;
        $oldamount = $latestCarton ? $latestCarton->amountbal : 0;        
        
        $kg = $request->kg;
        $currentamount = $kg * 80;
        $qtybal = $oldqty + $kg;
        $amountbal = $oldamount + $currentamount;
       

        CartonQty::create([
            'oldqty' => $oldqty,
            'kg' => $kg,
            'qtybal' => $qtybal,
            'oldamount' => $oldamount,
            'currentamount' => $currentamount,
            'amountbal' => $amountbal,
            'transactiontype' => 'credit',
        ]);

        return redirect()->back()->with('success', 'Carton added successfully.');
    }

     /**
     * Search the products based on various criteria.
     */
    public function search(Request $request)
    {
        $query = CartonQty::query();

       
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $cartons = $query->paginate(10);

        return view('searchcarton', compact('cartons'))->with('i', (request()->input('page', 1) - 1) * 10);
    } 
    
    
    public function processTransaction(Request $request)
    {
        $request->validate([
           
            'kg' => 'nullable|numeric|min:0',
          
        ]);

       

        // Get the latest carton record
        $latestCarton = CartonQty::latest()->first();
        $oldqty = $latestCarton ? $latestCarton->qtybal : 0;
        $oldamount = $latestCarton ? $latestCarton->amountbal : 0;

       if ($request->has('kg')) {
            // For purchase form
            $kg = $request->kg;
            $currentamount = $kg * 80;           
            $transactionType = 'debit';

            // Update carton records
            $qtybal = $oldqty - $kg;
        $amountbal = $oldamount - $currentamount;

        } else {
            return redirect()->back()->with('error', 'Invalid transaction data.');
        }

       

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

        

        return redirect()->back()->with('success', 'Transaction processed successfully.');
    }



}
