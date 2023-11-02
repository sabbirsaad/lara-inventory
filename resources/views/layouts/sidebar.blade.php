<div class="wrapper d-flex align-items-stretch">
  <nav id="sidebar">
    <div class="custom-menu">
      <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars"></i>
        <span class="sr-only">Toggle Menu</span>
      </button>
    </div>
    <div class="p-4 pt-5">
      {{-- <h1><a href="index.html" class="logo">Splash</a></h1> --}}
      <div class="text-center pb-4">
        <a href="/"><img class="img-thumbnail" width="130"
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqG4lRpjX07IHIE999-jy__tZWMF4s3_BpcfnDecDd32wRu3J3T6WxXi3ytPCPOT-De44&usqp=CAU"
            alt=""></a>
      </div>
      <ul class="list-unstyled components mb-5">

        <li>
          <a href="/dashboard"><i class="fa-solid fa-gauge me-2"></i>Dashboard</a>
        </li>
        <li>
          <a href="/inventories"><i class="fa-solid fa-warehouse me-2"></i>Inventory</a>
        </li>

        <li>
          <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
              class="fa-solid fa-cart-plus me-2"></i>Products</a>
          <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
              <a href="{{ route('products.create') }}">Add Product</a>
            </li>
            <li>
              <a href="{{ route('products.index') }}">Product List</a>
            </li>
          </ul>
        </li>

        <li>
          <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
              class="fa-solid fa-user-group me-2"></i>Customers</a>
          <ul class="collapse list-unstyled" id="pageSubmenu1">
            <li>
              <a href="{{ route('customers.create') }}">Add Customer</a>
            </li>
            <li>
              <a href="{{ route('customers.index') }}">Customer List</a>
            </li>

          </ul>
        </li>

        <li>
          <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
              class="fa-solid fa-landmark me-2"></i>Orders</a>
          <ul class="collapse list-unstyled" id="pageSubmenu2">
            <li>
              <a href="{{ route('orders.create') }}">Add Order</a>
            </li>
            <li>
              <a href="{{ route('orders.index') }}">Order List</a>
            </li>

          </ul>
        </li>

        <li>
          <a href="/students"><i class="fa-solid fa-graduation-cap me-2"></i>Student</a>
        </li>
        <div class="d-flex justify-content-between">

          <div>
            <a class="btn btn-success mt-5 shadow" href="/login"><i class="fa-solid fa-user"></i>
              Login</a>
          </div>
          <div>
            <a class="btn btn-secondary mt-5 shadow" href="/logout">Logout <i
                class="fa-solid fa-right-to-bracket"></i></a>
          </div>

        </div>

        <div class=" d-flex justify-content-center mt-5">
          <a href="/email" class="text-dark text-center bg-white rounded  py-3 shadow w-100">Send Feedback</a>
        </div>
      </ul>

    </div>
  </nav>

  <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5">
    @yield('content')
  </div>
</div>
