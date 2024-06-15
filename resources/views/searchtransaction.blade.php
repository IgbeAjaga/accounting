{{-- resources/views/searchtransaction.blade.php --}}
@extends('products.layout')

@section('content')

<div class="card mt-5">
  <div class="card-body">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
      <a class="btn btn-primary btn-sm" href="{{ route('alltransactions') }}">
        <i class="fa fa-arrow-left"></i> Back
      </a>
      <button class="btn btn-success btn-sm" onclick="window.print()">
        <i class="fa fa-print"></i> Print Invoice
      </button>
    </div>

    <!-- Small Table to show aggregated data -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Account Number:</strong> <br/>
                {{ $customer->account_number }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Customer's Name:</strong> <br/>
                {{ $customer->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone Number:</strong> <br/>
                {{ $customer->phone }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Old Balance (NGN):</strong> <br/>
                {{ $customer->old_balance }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Available Balance (NGN):</strong> <br/>
                {{ $customer->new_balance }}
            </div>
        </div>
    </div>

    <h2 class="card-header text-center text-primary"><strong>Transaction history</strong></h2>
    
    <table class="table table-bordered table-striped mt-4">
      <thead>
        <tr>
          <th width="80px">SN</th>
          <th>Account Number</th>
          <th>Old Balance (NGN)</th>
          <th>Amount</th>
          <th>Transaction Type</th>
          <th>Available Balance(NGN)</th>
          <th>Quantity (kg)</th>          
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($transactions as $transaction)
          <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $transaction->account_number }}</td>
            <td>{{ $transaction->old_balance }}</td>
            <td>{{ $transaction->amount }}</td>
            <td>{{ $transaction->transactiontype }}</td> 
            <td>{{ $transaction->new_balance }}</td>
            <td>{{ $transaction->quantity }}</td>                        
            <td>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="7">No results found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {!! $transactions->links() !!}
  </div>
</div>
@endsection
