@extends('layouts.app')
@section('title', 'Customers | create')
@section('content')
  <div>
    <div class="d-flex justify-content-between py-4">
      <div class="h4  py-2  px-4">
        Create Customer
      </div>
      <div>
        <a href="{{ route('customers.index') }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Back</a>
      </div>
    </div>
    <form action="{{ route('customers.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="card border-0 shadow-lg">
        <div class="card-body">
          <div class="mb-3">
            <label for="name" class="form-lebel">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" placeholder="Enter Name"
              class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}">
            @error('customer_name')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="email" class="form-lebel">Email</label>
            <input type="text" name="email" id="email" placeholder="Enter product code"
              class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="phone" class="form-lebel">Phone</label>
            <input type="number" name="phone" id="phone" placeholder=""
              class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
            @error('phone')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="address" class="form-lebel">Address</label>
            <textarea name="address" id="address" cols="30" rows="4" placeholder="Enter Address" class="form-control">{{ old('address') }}</textarea>
          </div>

        </div>
      </div>
      <button class="btn btn-primary mt-3">Add Customer</button>
    </form>
  </div>
@endsection
