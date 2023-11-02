@extends('layouts.app')
@section('title', 'Sales')
@section('content')
  <div>
    <div class="d-flex justify-content-between py-4">
      <div class="h4">
        Sales List
      </div>
      <div>
        <a href="{{ route('orders.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Place Order</a>
      </div>
    </div>
    @if (Session::has('success'))
      <div class="alert alert-success text-center">
        {{ Session::get('success') }}
      </div>
    @endif
    <div class="card border-0 shadow-lg">
      <div class="card-body">
        <table class="table table-striped">
          <thead class="table-dark">
            <tr>
              <th>Sl. No.</th>
              <th>Customer Name</th>
              <th>Total Product</th>
              <th>Total Quantity</th>
              <th>Total Price(Tk)</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if ($orders->isNotEmpty())
              @foreach ($orders as $order)
                <tr valign="middle">

                  <th>{{ $sl++ }}</th>
                  <td>{{ $order->customer->customer_name ?? '' }}</td>
                  <td>{{ count($order->orderDetails) }}</td>
                  <td>{{ $order->orderDetails->sum('quantity') }}</td>
                  <td>{{ $order->orderDetails->sum('sub_total') }}</td>
                  <td>
                    <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-warning btn-sm"> <i
                        class="fa-solid fa-eye"></i></a>
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
      {{ $orders->links('pagination::simple-bootstrap-4') }}
    </div>
  </div>

@endsection
