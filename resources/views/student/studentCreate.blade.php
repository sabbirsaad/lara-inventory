@extends('layouts.app')
@section('title', 'Students | create')
@section('content')
  <div class="my-5">
    <div class="d-flex justify-content-between py-4">
      <div class="h4  py-2  px-4">
        Create Student
      </div>
      <div>
        <a href="{{ route('students.index') }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Back</a>
      </div>
    </div>
    <form id="my_form">

      @csrf
      <div class="card border-0 shadow-lg">
        <div class="card-body">
          <div class="mb-3">
            <label for="name" class="form-lebel">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control "
              value="" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-lebel">Email</label>
            <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control"
              value="" required>
          </div>

          <div class="mb-3">
            <label for="image" class="form-lebel">Image</label>
            <input type="file" name="image" id="imageInput" class="form-control">

          </div>
          <div class="pt-2">
            <img id="imagePreview" src="" width="100">
          </div>
        </div>
      </div>
      <button class="btn btn-primary mt-3" type="submit" id="btnSubmit">Add Student</button>
    </form>
    <span id="output" class="text-success"></span>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {

      $('#my_form').submit(function(event) {
        event.preventDefault();

        var form = $('#my_form')[0];
        var data = new FormData(form);

        console.log(data);
        $('#btnSubmit').prop('disabled', true);
        $.ajax({
          type: "POST",
          url: "{{ route('students.store') }}",
          data: data,
          processData: false,
          contentType: false,
          success: function(data) {
            $('#output').text(data.res);
            $('#btnSubmit').prop('disabled', false);
            $("input[type='text']").val('');
            $("input[type='email']").val('');
            $("input[type='file']").val('');
            window.location = "{{ route('students.index') }}";
          },
          error: function(err) {
            $('#output').text(err.responseText);
            $('#btnSubmit').prop('disabled', false);
            $("input[type='text']").val('');
            $("input[type='email']").val('');
            $("input[type='file']").val('');
          }

        });

      });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Get the file input and image preview elements
      const imageInput = document.getElementById('imageInput');
      const imagePreview = document.getElementById('imagePreview');

      // Listen for changes in the file input
      imageInput.addEventListener('change', function() {
        const file = imageInput.files[0];

        if (file) {
          const reader = new FileReader();

          // Set up the FileReader to read the image as a data URL
          reader.readAsDataURL(file);

          // When the FileReader has loaded the image, set it as the source for the image preview
          reader.onloadend = function() {
            imagePreview.src = reader.result;
          };
        } else {
          // If no file is selected, reset the preview image source
          imagePreview.src = "";
        }
      });
    });
  </script>
@endpush
