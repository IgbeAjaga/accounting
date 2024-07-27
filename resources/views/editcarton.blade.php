@extends('products.layout')
    
@section('content')
  
<div class="card mt-5">
  <h2 class="card-header text-primary" style="text-align: center";>Edit Carton</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('allcartons') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <form action="{{ route('cartons.update',$carton->id) }}" method="POST">
        @csrf
        @method('PUT')  
       
    <input type="text" name="oldqty" placeholder=">Old Balance (kg)">
    <br>
    <br>
    <input type="text" name="kg" placeholder="Current Transaction (kg)">
    <br>
    <br>
    <input type="text" name="qtybal" placeholder="Available Balance (kg)">
    <br>
    <br>
    <input type="text" name="oldamount" placeholder="Old balance (NGN)">
    <br>
    <br>
    <input type="text" name="currentamount" placeholder="Recent Transaction (NGN)">
    <br>
    <br>
    <input type="text" name="amountbal" placeholder="Available Balance(NGN)">
    <br>
    <br>
    <!-- Add other fields if necessary -->
    
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
    </form>
  
  </div>
</div>
@endsection