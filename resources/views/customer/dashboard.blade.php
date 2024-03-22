@include('customer.navbar')
@section('content')



@if (Auth::check())
<?php $id=Auth::user()->id ?>
{{-- @foreach($products as $product)

<div class="mask d-flex align-items-center gradient-custom-3">
    <div class="container">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-3 col-xl-3 col-sm-3 col-lg-3">
          <div class="card bg-light mt-3" style="border-radius: 15px;">
            <div class="card-body p-5">
  <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
    <img src="{{asset('storage/images/products/'.$id.'/'.$product->image)}}" class="img-fluid"/>
    <a href="#!">
      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
    </a>
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$product->name}}</h5>
    <p class="card-text">{{$product->description}}</p>
    <p class="card-text">{{$product->price}}</p>

    <a href="#!" class="btn btn-primary" data-mdb-ripple-init>Button</a>
  </div>
</div>

          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach --}}
{{-- <div class="mask d-flex align-items-center gradient-custom-3">
    <div class="container">
        <div class="row justify-content-center">
            @foreach($products as $product)
            <div class="col-lg-4 mb-4"> <!-- Each card occupies 4 columns on large screens -->
                <div class="card bg-light" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                            <img src="{{ asset('storage/images/products/'.$id.'/'.$product->image) }}" class="img-fluid"/>
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">{{ $product->price }}</p>
                        <a href="#!" class="btn btn-primary" data-mdb-ripple-init>Button</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div> --}}

<div class="col-sm-12">
        
          <!-- success message here -->
          @if(session()->get('delete-success'))
          <div class="alert alert-success">
          <div class="alert alert-success">
            {{ session()->get('delete-success')}}
            session()->forget('delete-success')
</div>
    </div>
    @elseif (session()->get('delete-error'))
      <div class="alert alert-success">
          <div class="alert alert-danger">
            {{ session()->get('delete-error')}}
             session()->forget('delete-error')
</div>
    </div>
@endif
    
      </div>

<div class="mask d-flex align-items-center gradient-custom-3">
    <div class="container">
        <div class="row justify-content-center">
            @foreach($products as $product)
            <div class="col-lg-12 m-4"> <!-- Each card occupies 4 columns on large screens -->
                <div class="card bg-light p-2" style="border-radius: 15px; ">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-sm-4"> <!-- Image column -->
                                <div class="bg-image  hover-overlay" >
                                    <img src="{{ asset('storage/images/products/'.$id.'/'.$product->image) }}" class="img-fluid" style="border-top-left-radius: 15px; border-bottom-right-radius:15px; border-top-right-radius: 15px; border-bottom-left-radius: 15px; margin-right: 4px;"/>
                               
                                </div>
                            </div>
                            <div class="col-sm-6"> <!-- Details column -->
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="card-text">{{ $product->price }}</p>
                     
                                </div>
                            </div>
                              

                            <div class="col-sm-2"> <!-- Button column -->
                                <div class="card-body">
                                  <div class="d-flex justify-content-center m-2">
                  <a href="" class="btn btn-info" >Update</a>
                </div>
                <div class="d-flex justify-content-center m-2">
                   
                   <a href="{{route('customer.product.destroy',['id'=>$product->product_id])}}" class="btn btn-danger" >Delete</a>
                </div>
                 
                                </div>
                            </div>
                        </div>
                         
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endif

