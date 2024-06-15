@extends('products.layout')
  
@section('content')

<div class="card mt-5">
  <h2 class="card-header text-primary" style="text-align: center;">Single Transaction</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('alltransactions') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Account Number:</strong> <br/>
                {{ $transaction->account_number }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Amount:</strong> <br/>
                {{ $transaction->amount }}
            </div>
        </div>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Transaction Type:</strong> <br/>
                {{ $transaction->transactiontype }}
            </div>
        </div>       
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Old Balance(NGN):</strong> <br/>
                {{ $transaction->old_balance }}
            </div>
        </div>       
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Available Balance(NGN):</strong> <br/>
                {{ $transaction->new_balance }}
            </div>
        </div>       
    </div>      
  </div>
</div>
@endsection
