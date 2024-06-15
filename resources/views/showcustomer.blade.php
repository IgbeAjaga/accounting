@extends('products.layout')
  
@section('content')

<div class="card mt-5">
  <h2 class="card-header text-primary" style="text-align: center;">Single Report</h2>
  <div class="card-body">
  
  <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
      <a class="btn btn-primary btn-sm" href="{{ route('allcustomers') }}">
        <i class="fa fa-arrow-left"></i> Back
      </a>
      <button class="btn btn-success btn-sm" onclick="window.print()">
        <i class="fa fa-print"></i> Print Invoice
      </button>
    </div>
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Account Number:</strong> <br/>
                {{ $customer->account_number }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Customer's Name:</strong> <br/>
                {{ $customer->name }}
            </div>
        </div>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong> <br/>
                {{ $customer->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone Number:</strong> <br/>
                {{ $customer->phone }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Old Balance:</strong> <br/>
                {{ $customer->old_balance }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>New Balance:</strong> <br/>
                {{ $customer->new_balance }}
            </div>
        </div>
    </div>
  
  </div>
</div>
@endsection
