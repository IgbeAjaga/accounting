@extends('products.layout')

@section('content')

<div class="card mt-5">
  <div class="card-body">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
      <a class="btn btn-primary btn-sm" href="{{ route('allcartons') }}">
        <i class="fa fa-arrow-left"></i> Back
      </a>
      <button class="btn btn-success btn-sm" onclick="window.print()">
        <i class="fa fa-print"></i> Print
      </button>
    </div>    
        
        <h2 class="card-header text-center text-primary"><strong>DETAILS OF CARTON</strong> 
        @if(request('date_from')) from {{ request('date_from') }} @endif
        @if(request('date_to')) to {{ request('date_to') }} @endif
        </h2>
    <table class="table table-bordered table-striped mt-4">
      <thead>
        <tr>
        <th>SN</th>
        <th>Old Qty</th>
          <th>Newly Added</th>
          <th>Balance (kg)</th>
          <th>Old Amount (NGN)</th>
          <th>Newly Added Amount (NGN)</th>
          <th>Balance(NGN)</th>
          <th>Transaction Type(NGN)</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($cartons as $carton)
          <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $carton->oldqty }}</td>
            <td>{{ $carton->kg }}</td>
            <td>{{ $carton->qtybal }}</td>
            <td>{{ $carton->oldamount }}</td>
            <td>{{ $carton->currentamount }}</td>
            <td>{{ $carton->amountbal }}</td>
            <td>{{ $carton->transactiontype }}</td>            
            <td>{{ $carton->created_at->format('Y-m-d H:i:s') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="7">No results found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {!! $cartons->links() !!}
  </div>
</div>
@endsection
