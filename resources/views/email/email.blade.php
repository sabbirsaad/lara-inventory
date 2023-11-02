@extends('layouts.app')
@section('title', 'Email')
@section('content')
  <div class="mb-5 email">
    <div class="d-flex justify-content-between py-4">
      <div class="h4  py-2  px-4">
        Contact Form
      </div>
      <div>
        <a href="/dashboard" class="btn btn-primary"><i class="fa-solid fa-caret-left"></i> Back</a>
      </div>
    </div>
    <form action="{{ route('send.email') }}" method="post" enctype="multipart/form-data">

      @if (session()->has('message'))
        <div class="alert alert-success">
          {{ session()->get('message') }}
        </div>
      @endif

      @csrf
      <div class="card border-0 shadow-lg">
        <div class="card-body">

          <div class="mb-3">
            <label for="name" class="form-lebel">Name</label>
            <input type="text" name="name" placeholder="Enter Name"
              class="form-control @error('name') is-invalid @enderror" value="">
            @error('name')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-lebel">Email</label>
            <input type="text" name="email" placeholder="Enter email"
              class="form-control @error('email') is-invalid @enderror" value="">
            @error('email')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="subject" class="form-lebel">Subject</label>
            <input type="text" name="subject" placeholder="Enter Name"
              class="form-control @error('subject') is-invalid @enderror" value="">
            @error('subject')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="content" class="form-lebel">Message</label>

            <textarea name="content" placeholder="Message" cols="40"></textarea>
          </div>

        </div>
      </div>
      <button class="btn btn-primary mt-3">Send Feedback</button>
    </form>
  </div>
  <script>
    CKEDITOR.replace('content');
  </script>
@endsection
