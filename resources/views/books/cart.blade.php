@extends('layouts.store')

@section('content')
@section('styles')
<link rel="stylesheet" href="{{asset('css/cartstyles.css')}}">
@endsection

<div class="container">
    
   
    <div class="card  h-md-50x mt-1"  style="z-index: 1">
        <div class="row">
           
            <div class="loader" id="loader">
                <div class="loading-spinner"></div>
                <div class="loading-message alert alert-success"><h3>Please wait, processing...</h3></div>
            </div>
            <div id="data-container"></div>

            
            <div class="col-md-8 cart" > 
              
                <div class="row  ">
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                      @endif
                    
                        <h4 class="col"><b class="text-success">PAY KSH {{($book->price)}} THROUGH MPESA </b></h4>
                    
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid" src="https://www.adazing.com/wp-content/uploads/2019/02/open-book-clipart-03.png"></div>
                        <div class="col">
                            <div class="row" style="text-transform:uppercase;color:green">{{Str::limit($book->title, 35)}} >>{{Str::limit($book->class)}}</div>
                        </div>
                       
                        
                    </div>

                    
                    <form    id="myForm"  action="{{route('book.pay', ['bookId'=>$book->id, 'bookPrice'=>$book->price])}}" method="POST"> 
                      
                        @csrf

                      

                        <div class="col-md-12 form-group">
                            <label for="" class="form-label">PHONE </label>
                            <input type="text" class="form-control" name="phone" required placeholder="Enter your mpesa number here">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="form-label">EMAIL</label>
                            <input type="email" class="form-control" name="email" required placeholder="Enter email that will receive the item ">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="form-label">CONFIRM EMAIL</label>
                            <input type="email" class="form-control" name="email_confirmation" required placeholder="Confirm email that will receive the item ">
                        </div>
                            
                
                    <button type="submit" class="btn btn-info " style="margin-top:-2px">PAY NOW</button>
                    </form>


                </div>
              
                <div class="back-to-shop"  style="margin-top:-2px"><a href="/">&leftarrow; </a><span class="text-muted">Back to shop</span></div>
            </div>
            <div class="col-md-4 summary h-100x">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">Total Items </div>
                    <div class="col text-right">1</div>
                </div>

                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="colX">TOTAL PRICE:</div>
                    <div class="colX text-primary">KSHS {{$book->price}}</div>
                </div>
                <div class="row" style="border-top: 1px solid rgba(20, 37, 227, 0.1); padding: 2vh 0;">
                    <div class="colX ">DESCRIPTION:</div>
                    <div class="colx text-right text-primary">{{$book->desc}}</div>
                </div>
                <hr>
              
            </div>
        </div>
    </div>
</div>
@endsection