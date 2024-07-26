@extends('products.layout')
  
@section('content')

<div class="card mt-5">
  <h2 class="card-header text-primary" style="text-align: center;">Single Report</h2>
  <div class="card-body">
  
  <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
      <a class="btn btn-primary btn-sm" href="{{ route('allcartons') }}">
        <i class="fa fa-arrow-left"></i> Back
      </a>
      <button class="btn btn-success btn-sm" onclick="window.print()">
        <i class="fa fa-print"></i> Print Invoice
      </button>
    </div>
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Old Qty:</strong> <br/>
                {{ $carton->oldqty }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Newly Added:</strong> <br/>
                {{ $carton->kg }}
            </div>
        </div>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Balance (kg):</strong> <br/>
                {{ $carton->qtybal }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Old Amount (NGN):</strong> <br/>
                {{ $carton->oldamount }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Newly Added Amount (NGN):</strong> <br/>
                {{ $carton->currentamount }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Balance(NGN):</strong> <br/>
                {{ $carton->amountbal }}
            </div>
        </div>
    </div>
  
  </div>
</div>
@endsection
