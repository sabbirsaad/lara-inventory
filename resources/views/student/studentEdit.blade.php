@extends('layouts.app')
@section('title', 'Students | Edit')
@section('content')
  <div class="my-5">
    <div class="d-flex justify-content-between py-4">
      <div class="h4  py-2  px-4">
        Edit Student
      </div>
      <div>
        <a href="{{ route('students.index') }}" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Back</a>
      </div>
    </div>
    <form id="update_form">

      @csrf
      <div class="card border-0 shadow-lg">
        <div class="card-body">
          <div class="mb-3">
            <label for="name" class="form-lebel">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control "
              value="{{ $students[0]->name }}">
          </div>
          <div class="mb-3">
            <label for="email" class="form-lebel">Email</label>
            <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control"
              value="{{ $students[0]->email }}">
          </div>


          <div class="mb-3">
            <input type="hidden" name="id" id="id" value="{{ $students[0]->student_id }}">
            <label for="image" class="form-lebel"></label>
            <input type="file" name="image[]" id="imageInput">
            <div class="pt-2" id="load_image">
              @if ($students[0]->image != '' && file_exists(public_path() . '/uploads/students/' . $students[0]->image))
                <img src="{{ url('uploads/students/' . $students[0]->image) }}" height="80" width="80">
              @endif
            </div>
          </div>

          <div class="pt-2">
            <img id="imagePreview" src="" width="100">
          </div>

        </div>
      </div>
      <button class="btn btn-primary mt-3" type="submit">Update Student</button>
    </form>
    <span id="output" class="text-success"></span>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('#update_form').submit(function(e) {
        e.preventDefault();

        var form = $('#update_form')[0];
        var data = new FormData(form);

        $.ajax({
          type: "POST",
          url: "{{ route('students.update') }}",
          data: data,
          processData: false,
          contentType: false,
          success: function(data) {
            $("#output").text(data.res);
            window.location = "{{ route('students.index') }}";
          },
          error: function(err) {
            $("#output").text(err);
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
      const load_image = document.getElementById('load_image');

      // Listen for changes in the file input
      imageInput.addEventListener('change', function() {
        const file = imageInput.files[0];
        load_image.style.display = 'none';
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
