@extends('layouts.app')
@section('title', 'Products | unit')
@section('content')
  <div class="my-3">
    <div class="d-flex justify-content-between py-4">
      <div class="h4  py-2  px-4">
        Create Product Unit
      </div>
      <div>
        <a href="{{ route('products.index') }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Back</a>
      </div>
    </div>
    @if (Session::has('success'))
      <div class="alert alert-success text-center">
        {{ Session::get('success') }}
      </div>
    @endif
    <form action="{{ isset($unit) ? route('units.update', $unit->unit_id) : route('units.store') }} " method="post"
      enctype="multipart/form-data">

      @csrf
      @if (isset($unit))
        @method('PUT')
      @endif

      <div class="card border-0 shadow-lg">
        <div class="card-body">
          <div class="mb-3">
            <label for="unit_name" class="form-lebel">Unit Name</label>
            <input type="text" name="unit_name" id="unit_name" placeholder="Enter unit name"
              class="form-control @error('unit_name') is-invalid @enderror " value="{{ $unit->unit_name ?? '' }}">
            @error('unit_name')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-end">
        @if (isset($unit))
          <button class="btn btn-primary mt-3">update</button>
        @else
          <button class="btn btn-primary mt-3">Add</button>
        @endif
      </div>
    </form>
    <div class="row justify-content-center mt-3">
      <div class="col-10">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Unit List</h4>
            <div class="table-responsive">
              <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                <thead class="bg-dark text-white">
                  <tr>
                    <th class="text-center">SL. No.</th>
                    <th class="text-center">Unit Name</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($units as $unit)
                    <tr>
                      <th class="text-center">{{ $sl++ }}</th>
                      <td class="text-center">{{ $unit->unit_name }}</td>
                      <td class="text-center">
                        <a href="{{ route('units.edit', $unit->unit_id) }}" class="btn btn-success btn-sm" title="edit">
                          <i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="" class="btn btn-danger btn-sm" title="delete"> <i
                            class="fa-solid fa-circle-xmark"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
