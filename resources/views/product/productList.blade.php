@extends('layouts.app')
@section('title', 'Products')
@section('content')
  <div>
    <div class="d-flex justify-content-between py-4">
      <div class="h4">
        Product List
      </div>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" name="search" id="search" placeholder="Search here"
          aria-label="Search" value="{{ $search }}">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <div>
        <a href="{{ route('products.create') }}" class="btn btn-primary mx-3"><i class="fa-solid fa-plus"></i> Create
          Product</a>
        <a href="{{ route('units.index') }}" class="btn btn-secondary"><i class="fa-solid fa-plus"></i> Add Unit</a>
      </div>
    </div>
    @if (Session::has('success'))
      <div class="alert alert-success text-center">
        {{ Session::get('success') }}
      </div>
    @endif

    <div class="card border-0 shadow-lg">
      <div class="card-body">
        <table class="table border table-striped table-bordered text-nowrap table-hover">
          <thead class="table-dark">
            <tr>
              <th>Sl. No.</th>
              <th>Image</th>
              <th>Product Name</th>
              <th>Product Code</th>
              <th>Unit</th>
              <th>Stock</th>
              <th>Created at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            @if ($products->isNotEmpty())
              @foreach ($products as $product)
                <tr valign="middle">
                  <th>{{ $sl++ }}</th>

                  <td>
                    @if ($product->image != '' && file_exists(public_path() . '/uploads/products/' . $product->image))
                      <img src="{{ url('uploads/products/' . $product->image) }}" alt="" height="40"
                        width="40" class="rounded-circle">
                    @else
                      <img src="{{ url('assets/images/no-image.png') }}" alt="" height="40" width="40"
                        class="rounded-circle">
                    @endif
                  </td>
                  <td> {{ $product->product_name }}</td>
                  <td>{{ $product->product_code }}</td>
                  <td> {{ $product->units->unit_name }}</td>
                  <td> {{ $product->stocks->sum('stock') }}</td>
                  <td> {{ $product->created_at->format('d-M, Y') }}</td>
                  <td>

                    <a href=" {{ route('products.edit', $product->id) }}" class="btn btn-success btn-sm" title="edit">
                      <i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="{{ route('products.destroy', $product->id) }}" class="btn btn-danger btn-sm" title="delete"
                      onclick="return confirm('Are you sure you want to delete?')">
                      <i class="fa-solid fa-circle-xmark"></i></a>
                  </td>

                </tr>
              @endforeach
            @else
              {{-- <div class="alert alert-warning text-center">No data in list!</div> --}}
              <tr>
                <th colspan="8" class="text-danger text-center">No data found</th>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-3 d-flex justify-content-end">
      {{ $products->links('pagination::simple-bootstrap-4') }}
    </div>
  </div>
@endsection
