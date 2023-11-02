@extends('layouts.app')
@section('title', 'Inventories')
@section('content')
  <div>
    <div class="d-flex justify-content-between py-4">
      <div class="h4">
        Inventory List
      </div>
      <div>
        <a href="{{ route('inventories.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add New Inventory</a>
      </div>
    </div>
    @if (Session::has('success'))
      <div class="alert alert-success text-center">
        {{ Session::get('success') }}
      </div>
    @endif

    <div class="card border-0 shadow-lg">
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead class="table-dark">
            <tr>
              <th>Sl. No.</th>
              <th>Supplier</th>
              <th>Total Items</th>
              <th> Total Quantity</th>
              <th>Total Price(Tk)</th>
              <th>Received Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if ($inventories->isNotEmpty())
              @foreach ($inventories as $inventory)
                <tr valign="middle">
                  <th>{{ $sl++ }}</th>
                  <td>{{ $inventory->supplier }}</td>
                  <td>{{ count($inventory->inventoryDetails) }}</td>
                  <td>{{ $inventory->inventoryDetails->sum('quantity') }}</td>
                  <td>{{ $inventory->inventoryDetails->sum('sub_total') }}</td>
                  <td>{{ date('d M, Y', strtotime($inventory->received_date)) }}</td>
                  <td>
                    <a href="" class="btn btn-success btn-sm"> <i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="" class="btn btn-danger btn-sm"> <i class="fa-solid fa-circle-xmark"></i></a>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-3 d-flex justify-content-end">
      {{ $inventories->links('pagination::simple-bootstrap-4') }}
    </div>
  </div>
@endsection
