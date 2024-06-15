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

<form action="{{ route('create.customer') }}" method="post">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="phone" placeholder="Phone">
    <!-- Add other fields if necessary -->
    <button type="submit">Create Customer</button>
</form>
  
  </div>
</div>
@endsection
