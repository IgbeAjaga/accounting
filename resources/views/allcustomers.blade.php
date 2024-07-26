@extends('products.layout')
@section('content')
<div class="card mt-5">
  <h2 class="card-header text-center text-primary"><strong>ALL CUSTOMERS' ACCOUNT DETAILS</strong></h2>
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
      <a class="btn btn-success btn-sm" href="{{ route('create.customer') }}">
        <i class="fa fa-plus"></i> Add New Customer
      </a>  
    </div>

    <!-- Search Form -->
    <form action="{{ route('searchcustomer') }}" method="GET" class="mb-4">
      <div class="row">

      <div class="mb-3">
        <input type="text" name="account_number" placeholder="Account Number">
</div>
<div class="mb-3">
        <input type="text" name="name" placeholder="Customer's Name">
</div>
<div class="mb-3">
        <input type="email" name="email" placeholder="Customer's Email">
</div>
<div class="mb-3">
        <input type="text" name="phone" placeholder="Customer's Phone">
</div>
<div class="col-md-3">
          <input type="date" name="date_from" class="form-control" placeholder="From Date">
        </div>
        <div class="col-md-3">
          <input type="date" name="date_to" class="form-control" placeholder="To Date">
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search Customer</button>
        </div>
      </div>
    </form>    
    </div>

    <table class="table table-bordered table-striped mt-4">
      <thead>
        <tr>
          <th width="80px">SN</th>
          <th>Account Number</th>
          <th>Customer's Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Old Balance(NGN)</th>
          <th>Current Balance(NGN)</th>
          <th>Date</th>
          <th width="250px">Actions</th>
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
            <td>
              <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('customers.show', $customer->id) }}">
                  <i class="fa-solid fa-list"></i> Show
                </a>
                <a class="btn btn-primary btn-sm" href="{{ route('customers.edit', $customer->id) }}">
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
            <td colspan="9">There are no data.</td>
          </tr>
        @endforelse
      </tbody>
    </table>    
      {!! $customers->links() !!}      
  </div>   
</div>
@endsection
