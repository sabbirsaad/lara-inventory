<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <title>Custom authentication</title>
</head>

<body>
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center" style="height: 100vh">
      <div class="col-md-4 col-md-offset-4 mt-5">
        <h3 class="text-center mb-4">Registration</h3>
        <form action="{{ route('register-user') }}" method="post">
          @if (Session::has('success'))
            <div class="alert alert-success text-center">
              {{ Session::get('success') }}
            </div>
          @endif
          @csrf
          <div class="form-group mt-2">
            <label for="name">Full Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
              placeholder="Enter your Name" value="{{ old('name') }}">
            @error('name')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group mt-2">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
              placeholder="Enter your Email" value="{{ old('email') }}">
            @error('email')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group mt-2">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
              placeholder="Enter your Password">
            @error('password')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group mt-3">
            <button class="btn btn-block btn-primary" type="submit">
              Register
            </button>
          </div>
          <br>
          <h6>Already registered? <small><a href="login">Login here</a></small></h6>
        </form>

      </div>
    </div>
  </div>
</body>

</html>
