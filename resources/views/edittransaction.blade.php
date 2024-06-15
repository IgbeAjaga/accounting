@extends('products.layout')
    
@section('content')
  
<div class="card mt-5">
  <h2 class="card-header text-primary" style="text-align: center";>Edit Transaction</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('alltransactions') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <form action="{{ route('transactions.update',$transaction->id) }}" method="POST">
        @csrf
        @method('PUT')  
       
    <input type="text" name="account_number" placeholder="Account Number">
    <input type="text" name="amount" placeholder="amount">
    <input type="text" name="transactiontype" placeholder="Transaction Type">
    <!-- Add other fields if necessary -->
    
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
    </form>
  
  </div>
</div>
@endsection