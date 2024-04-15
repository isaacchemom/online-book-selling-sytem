{{-- @extends('layouts.store',compact('books')) --}}


@extends('layouts.store')
@section('content')

    <div class="containerX mt-2 bg-red">
       {{--   <div class="row">
            
            <div class="col-sm">
                
                <div class="card p-1X">
                    <a href="#" href="#" style="text-decoration:none">
                        
                        <div class="card-body">
                           
                            <small class="text-danger fa fa-sharp fa-solid fa-book">#1Trending</small><br>
                         <span class="card-text"><marquee> SCHEMES OF WORK </marquee> </span> &nbsp;
                                
                        </div>
                        
                         

                    </a>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 1 week ago</small>
                    </div>
                </div>
            
            </div>
           
            <div class="col-sm">
               
                <div class="card p-1">
                    <a href="#" href="#" style="text-decoration:none">
                        <div class="card-body">
                            <small class="text-danger">#2 Trending</small><br>
                            <span class="card-text">TERMLY LESSON PLANS &nbsp; &nbsp;<i
                                    class="fa fa-sharp fa-solid fa-book " style="font-size: 230%;"></i></span> &nbsp;


                        </div>
                    </a>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 1 week ago</small>
                    </div>
                </div>
            
            </div>
          
            <div class="col-sm">
               
                <div class="card p-1">
                    <a href="#" href="#" style="text-decoration:none">
                      
                        <div class="card-body">
                            <small class="text-danger fa fa-sharp fa-solid fa-book " style="font-size: 230">#3 Trending</small><br>
                            <span class="card-text"><marquee>PAST PAPERS & HOME WORK</marquee> &nbsp; &nbsp; 
                        </div>
                    
                    </a>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 1 week ago</small>
                    </div>
             
                </div>

            
            </div>
            
                <hr class="dropdown-divider" />
            
            
        </div>

    --}}

        <p class="container ">
          
         <span class="blink bg-success" style="color:white">GET TOP KCSE REVISION PAST PAPER, LESSON PLANS , SCHEMES OF WORK   FOR HELP CALL OR TEXT  24/7 : 071231121</span>
         <hr class="dropdown-divider" />
        </p>

    <!--END OF COUNT-->



    <!-- Section-->
    <section class="py-1 mt-4x">

        <div class="justify-content-center container  ">
             
            
             @if($check==3)

            <div class="row">
                @if ($books->count() > 0)
                    @foreach ($books as $book)
                        <div class="col-md-4">
                            <!-- <a href="{{ route('book', $book->id) }}">-->
                            <a href="{{ route('cart.add', $book->id) }}" class=" btn-outline-successx mt-auto "
                                style="text-decoration:none; text-transform:uppercase">
                                <div class="card h-100x bg-light  p-1">
                                    <!-- Sale badge
                                                <div class="badge bg-dark text-white position-absolute"
                                                    style="top: 0.5rem; right: 0.5rem">Sale
                                                </div>-->
                                    <!-- Product image-->
                                    <!-- <img class="card-img-topx" src="{{ $book->image }}" alt="..." height="20%"
                                                            width="10%" /> -->
                                    <!-- Product details-->
                                    <div class="card-body p-1 ">
                                        <div class="text-center fs-5x border border-success  ">
                                            <!-- Product name-->

                                            <div class="text-mutedx small roundedx "
                                                style="background-color:rgb(65, 165, 65); color:white; font-size:87%; ">
                                                <small> {{ Str::limit($book->title, 25) }} >
                                                    {{ Str::limit($book->class, 25) }} >
                                                    {{ Str::limit($book->categories->name, 25) }}</small>
                                            </div>

                                            <!-- Product reviews-->


                                            <div
                                                class="bi-star-fill small d-flex justify-content-center small text-primary mb-2 ">
                                                {{ $book->desc }}</div>

                                                <div class="card-footer bi-star-fillx" style="font-size: 82%">
                                                    <small class="text-muted">Last updated on:{{ $book->updated_at }} </small>
                                                </div>
                                                <div>
                                                    <hr class="dropdown-divider" />
                                                </div>

                                        
                                            <!-- Product price-->

                                            <div class="mt-autox p-1">
                                                <span style="font-size: 92%"
                                                    class="btn btn-light btn-outline-primary flex-shrink-0 mt-auto float-start ">Buy
                                                    now</span> <span class="float-end">KES {{ $book->price }}.00</span>
                                            </div>
                                            <hr/>
                                        </div>
                                    </div>

                                    <!--
                                                        <form class="d-flex" action="{{ route('cart.add', $book->id) }}" method="GET">
                                                            @csrf
                                                            <input class="form-control text-center me-3" name="price" value="{{ $book->price }}"
                                                                style="max-width: 3rem" />
                                                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                                                <i class="bi-cart-fill me-1"></i>
                                                                Buy Book
                                                            </button>

                                                        </form> -->



                                    <!-- Product actions-->
                                    <!--<div class="card-footer p-4 pt-0 border-top-0 bg-transparent ">
                                                            <div class="text-center"><a class="btn btn-outline-success mt-auto"
                                                                    href="{{ route('cart.add', $book->id) }}">Buy Now</a></div>
                                                        </div> -->
                                </div>
                            


                            </a>
                            <hr class="dropdown-divider" />
                         
                           
                        </div>
                      
                    @endforeach
                   
                @endif

            </div>

            @else
            



            @if ($myitems->count() > 0)
            <div class="row"> 
            @foreach ($myitems as $book)
            
                <div class="col-md-4">
                    <marquee> <i>GET YOUR  {{ Str::limit($book->categories->name, 25) }}  AT AFFORDABLE PRICES HERE!</i></marquee>
                    <hr class="dropdown-divider " />
                    <!-- <a href="{{ route('book', $book->id) }}">-->
                    <a href="{{ route('cart.add', $book->id) }}" class=" btn-outline-successx mt-auto "
                        style="text-decoration:none; text-transform:uppercase">
                        <div class="card h-100x bg-light  p-1">
                            <!-- Sale badge
                                        <div class="badge bg-dark text-white position-absolute"
                                            style="top: 0.5rem; right: 0.5rem">Sale
                                        </div>-->
                            <!-- Product image-->
                            <!-- <img class="card-img-topx" src="{{ $book->image }}" alt="..." height="20%"
                                                    width="10%" /> -->
                            <!-- Product details-->
                            <div class="card-body p-1 ">
                                <div class="text-center fs-5x border border-success  ">
                                    <!-- Product name-->

                                    <div class="text-mutedx small roundedx "
                                        style="background-color:rgb(65, 165, 65); color:white; font-size:87%; ">
                                        <small> {{ Str::limit($book->title, 25) }} >
                                            {{ Str::limit($book->class, 25) }} >
                                            {{ Str::limit($book->categories->name, 25) }}</small>
                                    </div>

                                    <!-- Product reviews-->


                                    <div
                                        class="bi-star-fill small d-flex justify-content-center small text-primary mb-2 ">
                                        {{ $book->desc }}</div>

                                        <div class="card-footer bi-star-fillx" style="font-size: 82%">
                                            <small class="text-muted">Last updated on:{{ $book->updated_at }} </small>
                                        </div>
                                        <div>
                                            <hr class="dropdown-divider" />
                                        </div>

                                
                                    <!-- Product price-->

                                    <div class="mt-autox p-1">
                                        <span style="font-size: 92%"
                                            class="btn btn-light btn-outline-primary flex-shrink-0 mt-auto float-start ">Buy
                                            now</span> <span class="float-end">KES {{ $book->price }}.00</span>
                                    </div>
                                    <hr/>
                                </div>
                            </div>

                            <!--
                                                <form class="d-flex" action="{{ route('cart.add', $book->id) }}" method="GET">
                                                    @csrf
                                                    <input class="form-control text-center me-3" name="price" value="{{ $book->price }}"
                                                        style="max-width: 3rem" />
                                                    <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                                        <i class="bi-cart-fill me-1"></i>
                                                        Buy Book
                                                    </button>

                                                </form> -->



                            <!-- Product actions-->
                            <!--<div class="card-footer p-4 pt-0 border-top-0 bg-transparent ">
                                                    <div class="text-center"><a class="btn btn-outline-success mt-auto"
                                                            href="{{ route('cart.add', $book->id) }}">Buy Now</a></div>
                                                </div> -->
                        </div>
                    


                    </a>
                    <hr class="dropdown-divider" />
                   
                </div>
              
            @endforeach
            <hr class="dropdown-divider " />
            <div>
        @endif

    </div>
           @endif
           
        </div>
        </div>

    </section>
@endsection
