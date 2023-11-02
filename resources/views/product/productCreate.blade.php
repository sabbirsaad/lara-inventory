@extends('layouts.app')
@section('title', 'Products | create')
@section('content')
  <div class="my-5">
    <div class="d-flex justify-content-between py-4">
      <div class="h4  py-2  px-4">
        Create Product
      </div>
      <div>
        <a href="{{ route('products.index') }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Back</a>
      </div>
    </div>
    <form action="{{ route('products.store') }} " method="post" enctype="multipart/form-data">

      @csrf
      <div class="card border-0 shadow-lg">
        <div class="card-body">
          <div class="mb-3">
            <label for="product_name" class="form-lebel">Product Name</label>
            <input type="text" name="product_name" id="product_name" placeholder="Enter Name"
              class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}">
            @error('product_name')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="product_code" class="form-lebel">Product Code</label>
            <input type="text" name="product_code" id="product_code" placeholder="Enter product code"
              class="form-control @error('product_code') is-invalid @enderror" value="{{ old('product_code') }}">
            @error('product_code')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="product_unit" class="form-lebel">Unit</label>
            <select class="form-select" name="product_unit" aria-label="Default select example" required>
              <option selected disabled value="">Select Unit</option>
              @foreach ($units as $unit)
                <option value="{{ $unit->unit_id }}">{{ $unit->unit_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="image" class="form-lebel">Image</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror

          </div>
        </div>
      </div>
      <button class="btn btn-primary mt-3">Add Product</button>
    </form>
  </div>
@endsection
