
@extends('user.base')
@section('content')

<div class="col-sm-12">

    @if (session()->get('store-error'))
    
        <div class="alert alert-danger">
            {{ session()->get('store-error')}}
            
        </div>
        <?php session()->forget('store-error')?>

    @elseif (session()->get('database-error'))
  
      <div class="alert alert-danger">
          {{ session()->get('database-error')}}
          
      </div>
      <?php session()->forget('database-error')?>
      
    @endif
  </div>
<div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card bg-dark mt-3" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5 text-white">Add Product</h2>


              <form method="POST" action="{{route('customer.product.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-outline mb-4 text-white">
                    <input type="text" id="name" name ="name" class="form-control form-control-lg bg-dark text-white"  value="{{ old('name') }}" />
                    <label class="form-label text-white" for="name" ><span class="text-danger">*</span>Product Name</label>
                   
                </div>


                <div class="form-outline mb-4">
                    <input type="textarea" id="description" name="description" class="form-control form-control-lg bg-dark text-white"  value="{{ old('description') }}" />
                    <label class="form-label text-white" for="description"><span class="text-danger">*</span>Description</label>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-outline mb-4">
                  <input type="number" id="price" name="price" class="form-control form-control-lg bg-dark text-white" value="{{ old('price') }}"/>
                  <label class="form-label text-white" for="contact_no"><span class="text-danger">*</span>Price of the Product</label>
                  @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-outline mb-4">
                  <input type="file" id="image" name="image" class="form-control form-control-lg bg-dark text-white" value="{{ old('image') }}"  />
                  <label class="form-label text-white" for="image"><span class="text-danger">*</span>Image</label>
                  @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <div class="form-outline mb-0">
                <p class="text-left text-bolt mt-0 mb-4 text-white">Fields with <span class="text-danger">*</span> are required fields</p>
                </div>


                 <div class="d-flex justify-content-center">
                  <button type="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Add Product</button>
                </div>

                      </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
                

@endsection