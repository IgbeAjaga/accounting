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
       
    <input type="text" name="oldqty" placeholder="Previous quantity added in kg">
    <br>
    <br>
    <input type="text" name="kg" placeholder="New quantity added in kg">
    <br>
    <br>
    <input type="text" name="qtybal" placeholder="Balance in kg">
    <br>
    <br>
    <input type="text" name="oldamount" placeholder="Previous quantity added in NGN">
    <br>
    <br>
    <input type="text" name="currentamount" placeholder="New quantity added in NGN">
    <br>
    <br>
    <input type="text" name="amountbal" placeholder="Balance in NGN">
    <br>
    <br>
    <!-- Add other fields if necessary -->
    
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
    </form>
  
  </div>
</div>
@endsection