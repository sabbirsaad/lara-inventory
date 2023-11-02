<?php
function greetings()
{
    // 24-hour format of an hour without leading zeros (0 through 23)
    date_default_timezone_set("Asia/Dhaka"); 
    $Hour = date('G');

    if ($Hour >= 5 && $Hour <= 11) {
        echo 'Good Morning';
    } elseif ($Hour >= 12 && $Hour <= 18) {
        echo 'Good Afternoon';
    } elseif ($Hour >= 19 || $Hour <= 4) {
        echo 'Good Evening';
    }
}
?>

@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
   <div class="row d-flex justify-content-center">
      <div class="col-md-4 col-md-offset-4 mt-5">
         <h3>{{ greetings() }} {{ $data->name }}</h3>
         <hr>
         <div class="card border-0 shadow-lg">
            <div class="card-body">
               <table class="table table-striped">
                  <thead class="table-dark">
                     <tr>
                        <th>Name</th>
                        <th>Email</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
@endsection
