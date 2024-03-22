
@extends('user.base')
@section('content')

<div class="col-sm-12">
        
    @if (session()->get('update-error'))
    
        <div class="alert alert-danger">
            {{ session()->get('update-error')}}
            
        </div>
        <?php session()->forget('update-error')?>
    @elseif (session()->get('database-error'))
    
        <div class="alert alert-danger">
            {{ session()->get('database-error')}}
            
        </div>
        <?php session()->forget('database-error')?>
    @elseif (session()->get('update-error'))

    <div class="alert alert-danger">
        {{ session()->get('update-error')}}
        
    </div>
    <?php session()->forget('update-error')?>

@endif
<div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card bg-dark mt-3" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5 text-white">update product</h2>


              <form method="POST" action="{{route('customer.product.update',['id'=>$product->product_id])}}" enctype="multipart/form-data">
                @csrf
                <div class="form-outline mb-4 text-white">
                    <input type="text" id="name" name ="name" class="form-control form-control-lg bg-dark text-white"  value="{{$product->name}}" />
                    <label class="form-label text-white" for="name" ><span class="text-danger">*</span>Product Name</label>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-outline mb-4">
                    <input type="textarea" id="description" name="description" class="form-control form-control-lg bg-dark text-white"  value="{{$product->description }}" />
                    <label class="form-label text-white" for="description"><span class="text-danger">*</span>Description</label>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-outline mb-4">
                  <input type="number" id="price" name="price" class="form-control form-control-lg bg-dark text-white" value="{{ $product->price }}"/>
                  <label class="form-label text-white" for="contact_no"><span class="text-danger">*</span>Price of the Product</label>
                  @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-outline mb-4">
                  <input type="file" id="image" name="image" class="form-control form-control-lg bg-dark text-white" value="{{ $product->image }}"  />
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
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Update Product</button>
                </div>

                      </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
                

@endsection