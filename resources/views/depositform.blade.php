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

    @if(session('success'))
      <div class="alert alert-success mt-3">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger mt-3">
        {{ session('error') }}
      </div>
    @endif

    <form action="{{ route('process.transaction') }}" method="post">
      @csrf
      <div class="form-group mt-3">
        <input type="text" name="account_number" class="form-control" placeholder="Account Number" required>
      </div>
      <div class="form-group mt-3">
        <input type="number" name="amount" class="form-control" placeholder="Amount (for deposit)">
      </div>
      <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Make Deposit</button>
      </div>
    </form>

  </div>
</div>
@endsection
