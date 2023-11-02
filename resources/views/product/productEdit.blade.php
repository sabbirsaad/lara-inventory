@extends('layouts.app')
@section('title', 'Products | edit')
@section('content')
  <div>
    <div class="d-flex justify-content-between py-4">
      <div class="h4  py-2  px-4">
        Edit Product
      </div>
      <div>
        <a href="{{ route('products.index') }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Back</a>
      </div>
    </div>
    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="card border-0 shadow-lg">
        <div class="card-body">
          <div class="mb-3">
            <label for="product_name" class="form-lebel">Product Name</label>
            <input type="text" name="product_name" id="product_name" placeholder="Enter Name"
              class="form-control @error('product_name') is-invalid @enderror"
              value="{{ old('product_name', $product->product_name) }}">
            @error('product_name')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="product_code" class="form-lebel">Product Code</label>
            <input type="text" name="product_code" id="product_code" placeholder="Enter product code"
              class="form-control @error('product_code') is-invalid @enderror"
              value="{{ old('product_code', $product->product_code) }}">
            @error('product_code')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="image" class="form-lebel"></label>
            <input type="file" name="image" class="@error('image') is-invalid @enderror">
            @error('image')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror

            <div class="pt-3">
              @if ($product->image != '' && file_exists(public_path() . '/uploads/products/' . $product->image))
                <img src="{{ url('uploads/products/' . $product->image) }}" alt="" height="80" width="80"
                  class="">
              @endif
            </div>
          </div>
        </div>
      </div>
      <button class="btn btn-primary mt-3">Update Product</button>
    </form>
  </div>
@endsection
