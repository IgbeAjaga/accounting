@extends('products.layout')
    
@section('content')
  
<div class="card mt-5">
  <h2 class="card-header text-primary text-center">Add New Deposit</h2>
  <div class="card-body">
    
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a class="btn btn-success btn-sm" href="{{ route('dashboard') }}">
        <i class="fa fa-home"></i> Dashboard
      </a>
</div>

<form action="{{ route('process.transaction') }}" method="post">
    @csrf
    <input type="text" name="account_number" placeholder="Account Number">
    <input type="number" name="amount" placeholder="Amount">
    <button type="submit">Make Deposit</button>
</form>

  
  </div>
</div>
@endsection
