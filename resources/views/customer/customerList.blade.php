@extends('layouts.app')
@section('title', 'Customers')
@section('content')
  <div>
    <div class="d-flex justify-content-between py-4">
      <div class="h4">
        Customer List
      </div>
      <div class="d-flex">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" name="search" id="search" placeholder="Search here"
            aria-label="Search" value="">
        </form>
        <div>
          <a href="{{ route('customers.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create</a>
        </div>
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
              <th>Customer Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>address</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="alldata">
            @if ($customers->isNotEmpty())
              @foreach ($customers as $customer)
                <tr valign='middle'>
                  <th>{{ $sl++ }}</th>
                  <td>{{ $customer->customer_name }}</td>
                  <td>{{ $customer->email }}</td>
                  <td>{{ $customer->phone }}</td>
                  <td>{{ $customer->address }}</td>
                  <td>
                    <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-success btn-sm"> <i
                        class="fa-regular fa-pen-to-square"></i></a>
                    <a href="" class="btn btn-danger btn-sm"> <i class="fa-solid fa-circle-xmark"></i></a>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
          <tbody id="search_data">

          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-3 d-flex justify-content-end">
      {{ $customers->links('pagination::simple-bootstrap-4') }}
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {

      $("#search").on('keyup', function() {
        $value = $(this).val();
        if ($value) {
          $('.alldata').hide();
          $('#search_data').show();
        } else {
          $('.alldata').show();
          $('#search_data').hide();
        }
        $.ajax({
          type: 'GET',
          url: "/customers/search",
          data: {
            'search': $value
          },
          success: function(data) {
            var html = '';
            if (data.customers.length > 0) {
              for (let i = 0; i < data.customers.length; i++) {
                html +=
                  `<tr>
                  <th>` + (i + 1) + `</th>
                  <td>` + (data.customers[i]['customer_name']) + `</td>
                  <td>` + (data.customers[i]['email']) + `</td>
                  <td>` + (data.customers[i]['phone']) + `</td>
                  <td>` + (data.customers[i]['address']) + `</td>
                  <td>
                    <a href="customers/` + (data.customers[i]['customer_id']) + `/edit" class="btn btn-success btn-sm"> <i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="" class="btn btn-danger btn-sm"> <i class="fa-solid fa-circle-xmark"></i></a>
                  </td>
                  
                  </tr>`


              }
            } else {
              html = `<tr>
                  <th  class="text-center text-danger" colspan="6">` + "No data found" + `</th>

                </tr>`
            }

            $('#search_data').html(html);
          },
          error: function(err) {

          }
        });
      });
    });
  </script>
@endpush
