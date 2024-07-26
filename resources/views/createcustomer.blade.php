@extends('products.layout')
    
@section('content')
  
<div class="card mt-5">
  <h2 class="card-header text-primary text-center">Add New Customer</h2>
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

<form action="{{ route('create.customer') }}" method="post">
    @csrf
    <div class="form-group mt-3">
    <input type="text" name="name" placeholder="Name" class="form-control" required>
</div>
<div class="form-group mt-3">
    <input type="email" name="email" placeholder="Email" class="form-control" required>
</div>
<div class="form-group mt-3">
    <input type="text" name="phone" placeholder="Phone" class="form-control" required>
</div>
    <!-- Add other fields if necessary -->
    <div class="form-group mt-3">
    <button type="submit">Create Customer</button>
</div>
</form>
  
  </div>
</div>
@endsection
