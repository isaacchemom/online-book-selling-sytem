 {{--@extends('layouts.store') 
 @section('content') --}}
<div class="container mt-5x py-5">



    @if(session()->has('error'))
    <p class="alert alert-danger">{{session('error')}}</p>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="row container">
        <div class="col-md-8 offset-md-2">
          
            <h5 class="alert alert-danger">THANK YOU FOR SHOPING WITH US</h5>
        </div>
    </div>
</div>

{{--  @endsection --}}