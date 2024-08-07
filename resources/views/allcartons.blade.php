@extends('products.layout')
@section('content')
<div class="card mt-5">
  <h2 class="card-header text-center text-primary"><strong>ALL CARTONS ACCOUNT DETAILS</strong></h2>
  <div class="card-body">

    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a class="btn btn-success btn-sm" href="{{ route('dashboard') }}">
        <i class="fa fa-home"></i> Dashboard
      </a>
      <a class="btn btn-success btn-sm" href="{{ route('cartonqty.add') }}">
        <i class="fa fa-plus"></i> Add New Carton
      </a>  
    </div>

    <!-- Search Form -->
    <form action="{{ route('searchcarton') }}" method="GET" class="mb-4">
      <div class="row">
      
<div class="col-md-3">
          <input type="date" name="date_from" class="form-control" placeholder="From Date">
        </div>
        <div class="col-md-3">
          <input type="date" name="date_to" class="form-control" placeholder="To Date">
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search Carton</button>
        </div>
      </div>
    </form>    
    </div>

    <table class="table table-bordered table-striped mt-4">
      <thead>
        <tr>
          <th width="80px">SN</th>
          <th>Old Balance (kg)</th>
          <th>Recent Transaction (kg)</th>
          <th>Available Balance (kg)</th>
          <th>Old balance (NGN)</th>
          <th>Recent Transaction (NGN)</th>
          <th>Available Balance(NGN)</th>
          <th>Transaction type</th>
          <th>Date</th>
          <!-- <th width="250px">Actions</th> -->
        </tr>
      </thead>
      <tbody>
        @forelse ($cartons as $carton)
          <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $carton->oldqty }}</td>
            <td>{{ $carton->kg }}</td>
            <td>{{ $carton->qtybal }}</td>
            <td>{{ $carton->oldamount }}</td>
            <td>{{ $carton->currentamount }}</td>
            <td>{{ $carton->amountbal }}</td>
            <td>{{ $carton->transactiontype }}</td>
            <td>{{ $carton->created_at->format('Y-m-d H:i:s') }}</td>
            <!--
            <td>
            <form action="{{ route('cartons.destroy', $carton->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('cartons.show', $carton->id) }}">
                  <i class="fa-solid fa-list"></i> Show
                </a>
                <a class="btn btn-primary btn-sm" href="{{ route('cartons.edit', $carton->id) }}">
                  <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                  <i class="fa-solid fa-trash"></i> Delete
                </button>
              </form>
            </td>
-->
          </tr>
        @empty
          <tr>
            <td colspan="9">There are no data.</td>
          </tr>
        @endforelse
      </tbody>
    </table>    
      {!! $cartons->links() !!}      
  </div>   
</div>
@endsection
