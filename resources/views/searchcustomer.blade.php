@extends('products.layout')

@section('content')

<div class="card mt-5">
  <div class="card-body">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
      <a class="btn btn-primary btn-sm" href="{{ route('allcustomers') }}">
        <i class="fa fa-arrow-left"></i> Back
      </a>
      <button class="btn btn-success btn-sm" onclick="window.print()">
        <i class="fa fa-print"></i> Print
      </button>
    </div>    
        
        <h2 class="card-header text-center text-primary"><strong>DETAILS OF ACCOUNT</strong> 
        @if(request('account_number'))  {{ request('account_number') }} @endif
        @if(request('name')) account number {{ request('name') }} - @endif
        @if(request('email')) {{ request('email') }} name @endif
        @if(request('phone')) {{ request('phone') }} email @endif
        @if(request('date_from')) from {{ request('date_from') }} @endif
        @if(request('date_to')) to {{ request('date_to') }} @endif
        </h2>
    <table class="table table-bordered table-striped mt-4">
      <thead>
        <tr>
        <<th>SN</th>
          <<th>Account Number</th>
          <th>Customer's Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Old Balance(NGN)</th>
          <th>Available Balance(NGN)</th>          
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($customers as $customer)
          <tr>
          <td>{{ ++$i }}</td>
            <td>{{ $customer->account_number }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->old_balance }}</td>
            <td>{{ $customer->new_balance }}</td>            
            <td>{{ $customer->created_at->format('Y-m-d H:i:s') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="7">No results found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {!! $customers->links() !!}
  </div>
</div>
@endsection
