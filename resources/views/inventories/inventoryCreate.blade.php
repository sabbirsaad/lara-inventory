@push('links')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    // datepicker
    $('#received_date').datepicker({
      uiLibrary: 'bootstrap5',
      format: 'yyyy-mm-dd'
    });

    // select2 pakage
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });

    // multiply
    function multi() {
      var purchase_price = document.getElementById('purchase_price').value;
      var quantity = document.getElementById('quantity').value;
      var sub_total = (purchase_price * quantity).toFixed(2);
      document.getElementById('sub_total').value = sub_total;
    }

    // bootstrap validation
    (function() {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function(form) {
          form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
  </script>


  {{-- Add a table row on click --}}
  <script>
    $(document).ready(function() {
      $('.table').hide();

      $("#add_btn").click(function(e) {
        e.preventDefault();
        $('.table').show();
        var product_name = $("#product_id").find(":selected").text();
        var product_id = $("#product_id").find(":selected").val();
        var purchase_price = $("#purchase_price").val();
        var quantity = $("#quantity").val();
        var sub_total = $("#sub_total").val();

        var input_product_id = '<input name="product_id[]" type="hidden" value="' + product_id + '"/>';
        var input_purchase_price = '<input name="purchase_price[]" type="hidden" value="' + purchase_price +
          '"/>';
        var input_quantity = '<input name="quantity[]" type="hidden" value="' + quantity + '"/>';
        var input_sub_total = '<input name="sub_total[]" type="hidden" value="' + sub_total + '"/>';


        var markup =
          "<tr><td>" + input_product_id + input_purchase_price + input_quantity + input_sub_total +
          product_name + "</td>" + "<td>" +
          purchase_price + "</td><td>" + quantity +
          "</td><td>" + sub_total +
          "</td><td><span class='btn btn-sm btn-danger' id='del_row' > <i class='fa-solid fa-circle-xmark'></i></span></td></tr>";

        $("table tbody").append(markup);
      });
      // remove selected table rows

      $("#myTableRow").delegate('#del_row', 'click', function() {
        $(this).closest('tr').remove();

      });

    });
  </script>
@endpush

@extends('layouts.app')
@section('title', 'Inventory | create')
@section('content')
  <div class="my-5">
    <div class="d-flex justify-content-between py-4">
      <div class="h4  py-2  px-4">
        Add Product Inventory
      </div>
      <div>
        <a href="{{ route('inventories.index') }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Back</a>
      </div>
    </div>
    <form action="{{ route('inventories.store') }}" method="post" enctype="multipart/form-data" class="needs-validation"
      novalidate>
      @csrf
      <div class="card border-0 shadow-lg">
        <div class="card-body row">

          <div class="mb-3 col-md-6">
            <label for="supplier" class="form-lebel">Supplier</label>
            <input type="text" name="supplier" id="supplier" placeholder="Enter supplier name" class="form-control"
              value="{{ old('supplier') }}" required>
            <div class="invalid-feedback">
              Supplier name is required
            </div>
          </div>

          <div class="mb-3 col-md-6">
            <label for="product_id" class="form-lebel">Product Name</label>
            <select class="form-select js-example-basic-single" id="product_id" aria-label="Default select example"
              required>
              <option selected disabled value="">Select Product</option>
              @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">
              Please select a Product
            </div>
          </div>

          <div class="mb-3 col-md-6">
            <label for="purchase_price" class="form-lebel">Purchase Price</label>
            <input type="number" name="purchase_price" id="purchase_price" placeholder="Enter purchase price"
              onchange="return multi();" class="form-control" value="{{ old('purchase_price') }}" required>
            <div class="invalid-feedback">
              Purchase price is required
            </div>
          </div>

          <div class="mb-3 col-md-6">
            <label for="quantity" class="form-lebel">Quantity</label>
            <input type="number" name="quantity" id="quantity" placeholder="Pcs" onchange="return multi();"
              class="form-control" value="{{ old('quantity') }}" required>
            <div class="invalid-feedback">
              Quantity is required
            </div>
          </div>

          <div class="mb-3 ">
            <label for="sub_total" class="form-lebel">Sub Total</label>
            <input type="number" readonly id="sub_total" placeholder="" class="form-control" value="">
          </div>

        </div>
      </div>
      <button class="btn btn-primary mt-3" id="add_btn" type="submit">Add</button>

      <article class="m-5">
        <div class="section-header">
          <h5 class="text-dark font-20 mb-0 ">Item List</h5>
        </div>
        <hr>

        <div class="row justify-content-center">
          <div class="col-12 col-lg-12 table-responsive item-list-table-container">
            <table class="table text-center film">
              <thead>
                <tr>
                  <th scope="col">Product Name</th>
                  <th scope="col">Purchase price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Subtotal</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id='myTableRow'>
              </tbody>
            </table>
          </div>

        </div>
      </article>

      <article>
        <div class="section-header">
          <h5 class="text-dark font-20 mb-0 ">Summary</h5>
        </div>
        <hr>
        <div class="row">

          <div class="col-12 col-lg-3 mb-3">
            <div class="form-group">
              <label for="chalan_no" class="form-lebel">Chalan no</label>
              <input type="text" name="chalan_no" id="chalan_no" placeholder="" class="form-control" value=""
                required>
            </div>
            <div class="invalid-feedback">
              Chalan no. is required
            </div>
          </div>

          <div class="col-12 col-lg-3 mb-3">
            <div class="form-group">
              <label for="remarks" class="form-lebel">Remarks</label>
              <input type="text" name="remarks" id="remarks" placeholder="" class="form-control" value="">
            </div>
          </div>

          <div class="col-12 col-lg-3 mb-3">
            <label for="received_date" class="form-lebel">Received Date</label>
            <div class="input-group date" id="datepicker">
              <input type="text" name="received_date" class="form-control" id="received_date"
                placeholder="yyyy-mm-dd" autocomplete="off" />
              <span class="input-group-append">
                <span class="input-group-text bg-light d-block date_icon">
                  <i class="fa fa-calendar"></i>
                </span>
              </span>
            </div>
          </div>

          <div class="col-12 col-lg-3 mb-3 d-flex align-items-center">
            <button class="btn btn-primary mt-4 py-2">Save</button>
          </div>
        </div>
      </article>

    </form>
  </div>
@endsection
