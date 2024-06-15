@extends('products.layout')
@section('content')
<div class="card mt-5">
  <h2 class="card-header text-center text-primary"><strong>ALL CUSTOMERS' TRANSACTIONS</strong></h2>
  <div class="card-body">

    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a class="btn btn-success btn-sm" href="{{ route('dashboard') }}">
        <i class="fa fa-home"></i> Dashboard
      </a>
</div>

    <!-- Search Form -->
    <form action="{{ route('searchtransaction') }}" method="GET" class="mb-4">
      <div class="row">
        
      <div class="mb-3">
      <input type="text" name="account_number" placeholder="Account Number"> 
</div>
<div class="col-md-3">
          <input type="date" name="date_from" class="form-control" placeholder="From Date">
        </div>
        <div class="col-md-3">
          <input type="date" name="date_to" class="form-control" placeholder="To Date">
        </div>
    <div class="col-md-3">
          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search Transaction</button>
        </div>
      </div>
    </form>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a class="btn btn-success btn-sm" href="{{ route('deposit.form') }}">
        <i class="fa fa-plus"></i> Make New Deposit
      </a>
      
      <a class="btn btn-success btn-sm" href="{{ route('purchase.form') }}">
        <i class="fa fa-plus"></i> Make New Purchase
      </a>  
      
      <a class="btn btn-secondary btn-sm" href="{{ route('transactions.export') }}">
        <i class="fa fa-file-excel"></i> Export to Excel
      </a>
    </div>

    <table class="table table-bordered table-striped mt-4">
      <thead>
        <tr>
          <th width="80px">SN</th>
          <th>Account Number</th>
          <th>Old Balance(NGN)</th>
          <th>Amount (Naira)</th>
          <th>Transaction Type</th>
          <th>Available Balance(NGN)</th>
          <th>Quantity (kg)</th>          
          <th>Date</th>
          <th width="250px">Action</th>
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
<td>
              <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('transactions.show', $transaction->id) }}">
                  <i class="fa-solid fa-list"></i> Show
                </a>
                <a class="btn btn-primary btn-sm" href="{{ route('transactions.edit', $transaction->id) }}">
                  <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                  <i class="fa-solid fa-trash"></i> Delete
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6">There are no data.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    {!! $transactions->links() !!}   
  </div>
</div>
@endsection
