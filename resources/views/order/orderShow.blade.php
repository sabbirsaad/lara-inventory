@extends('layouts.app')
@section('title', 'Sales Invoice')
@section('content')
  <div>
    <div class="d-flex justify-content-between">
      <div>
        <div class="order_img">
          <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqG4lRpjX07IHIE999-jy__tZWMF4s3_BpcfnDecDd32wRu3J3T6WxXi3ytPCPOT-De44&usqp=CAU"
            alt="" class="img-fluid">
        </div>
        <p class="mt-3 mb-1">PrimeTech Solution Ltd.</p>
        <p>T.K Tower(7th floor), Kawran Bazar</p>
      </div>
      <div class="d-flex flex-column align-items-start justify-content-center">
        <h1>Invoice</h1>
        <h6>Date: {{ date('d-m-Y') }}</h6>
        <h6>Invoice no.: {{ hexdec(uniqid()) }}</h6>
      </div>
    </div>
    <hr>
    <div class="invoice_details">
      <h6>Customer name: <small>{{ $order->customer->customer_name ?? '' }}</small></h6>
      <h6>Total Product: <small>{{ count($order->orderDetails) }}</small></h6>
      <h6>Total Quantity: <small>{{ $order->orderDetails->sum('quantity') }}</small></h6>
      <h6>Total Price: <small>{{ $order->orderDetails->sum('sub_total') }}</small></h6>
      <h6>Tax: <small>3%</small></h6>
      <h6>Total:
        <small>{{ $order->orderDetails->sum('sub_total') * (1 + 3 / 100) }}</small>
      </h6>

    </div>
  </div>

@endsection
