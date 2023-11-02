@extends('layouts.app')
@section('title', 'Students')
@section('content')
  <div>
    <div class="d-flex justify-content-between py-4">
      <div class="h4">
        Student List
      </div>
      <div>
        <a href="{{ route('students.create') }}" class="btn btn-primary mx-3"><i class="fa-solid fa-plus"></i> Create
          Student</a>
      </div>
    </div>
    {{-- @if (Session::has('success'))
      <div class="alert alert-success text-center">
        {{ Session::get('success') }}
      </div>
    @endif --}}
    <span id="output"></span>
    <div class="card border-0 shadow-lg">
      <div class="card-body">
        <table class="student_table table border table-striped table-bordered text-nowrap">
          <thead class="table-dark">
            <tr class="text-center">
              <th>Sl. No.</th>
              <th>Image</th>
              <th>Student Name</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr valign="middle">

            </tr>
          </tbody>
        </table>
      </div>
    </div>
    {{-- <div class="mt-3 d-flex justify-content-end">
      {{ $products->links('pagination::simple-bootstrap-4') }}
    </div> --}}
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $.ajax({
        type: "GET",
        url: "{{ route('students.show') }}",
        success: function(data) {

          if (data.students.length > 0) {
            for (let i = 0; i < data.students.length; i++) {
              let img = data.students[i]['image'];
              $(".student_table").append(

                `<tr>
                    <th class="text-center">` + (i + 1) + `</th>
                    <td class="text-center">
                        <img src="{{ asset('uploads/students/`+img+`') }}" alt="` + img + `" height="40" width="40"
                        class="rounded-circle" />
                    </td>
                    <td class="text-center">` + (data.students[i]['name']) + `</td>
                    <td class="text-center">` + (data.students[i]['email']) + `</td>
                    <td class="text-center">
                        <a href="students/` + (data.students[i]['student_id']) + `/edit" class="btn btn-success btn-sm" title="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                        <button class="btn btn-danger btn-sm" id="del_row" data-id = " ` + (data.students[i][
                  'student_id'
                ]) + `"><i class="fa-solid fa-circle-xmark"></i></button>
                    
                    </td>

                </tr>`

              )
            }
          } else {
            $(".student_table").append("<tr><td colspan='4'> Data not found</td></tr>");
          }
        },
        error: function(err) {
          console.log(err.responseText);
        }
      });

      $(".student_table").on('click', '#del_row', function() {

        var id = $(this).attr('data-id');
        var obj = $(this);

        if (confirm('Are you sure you want to delete?')) {
          $.ajax({
            type: "GET",
            url: '/students/' + id,
            success: function(data) {
              $(obj).parent().parent().remove();

              console.log(data.res);
            },
            error: function(err) {
              $('#output').text(err.res);
            }
          });
        }

      });
    });
  </script>
@endpush
