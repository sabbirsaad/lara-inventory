<nav class="navbar navbar-expand-lg navbar-light bg-info px-5 py-3">
  <div class="container-fluid ">
    {{-- <h2> <a class="navbar-brand" href="/dashboard">Lara_Inventory</a></h2> --}}
    <a href="/"><img class="img-thumbnail" height="60" width="60"
        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqG4lRpjX07IHIE999-jy__tZWMF4s3_BpcfnDecDd32wRu3J3T6WxXi3ytPCPOT-De44&usqp=CAU"
        alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-5">

        <li class="nav-item">
          <a class="nav-link active " aria-current="page" href="/dashboard"><i class="fa-solid fa-gauge"></i>
            Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/inventories">Inventory Management</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('products.create') }}">Add Product</a></li>
            <li><a class="dropdown-item" href="{{ route('products.index') }}">Product List</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Customers
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('customers.create') }}">Add Customer</a></li>
            <li><a class="dropdown-item" href="{{ route('customers.index') }}">Customer List</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Orders
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('orders.create') }}">Add Order</a></li>
            <li><a class="dropdown-item" href="{{ route('orders.index') }}">Order List</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/students">Students</a>
        </li>

      </ul>
      <form class="d-flex">
        <button class="btn btn-success mx-3"><a class="log-btn" href="/login"><i class="fa-solid fa-user"></i>
            Login</a></button>
        <button class="btn btn-outline-danger "><a class="log-btn" href="/logout">Logout <i
              class="fa-solid fa-right-to-bracket"></i></a></button>
      </form>
    </div>
  </div>
</nav>
