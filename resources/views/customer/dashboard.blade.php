@include('customer.navbar')

@if (Auth::check())
    <?php $id = Auth::user()->id; ?>

    <div class="col-sm-12">
        @if (session()->get('update-success'))
            <div class="alert alert-success">
                {{ session()->get('update-success') }}

            </div>
            <?php session()->forget('update-success'); ?>
            
        @elseif(session()->get('delete-success'))
            <div class="alert alert-success">
                {{ session()->get('delete-success') }}

            </div>
            <?php session()->forget('delete-success'); ?>

        @elseif(session()->get('store-success'))
        <div class="alert alert-success">
            {{ session()->get('store-success') }}

        </div>
        <?php session()->forget('store-success'); ?>
        
        @elseif (session()->get('delete-error'))
            <div class="alert alert-danger">
                {{ session()->get('delete-error') }}

            </div>

            <?php session()->forget('delete-error'); ?>
        @elseif (session()->get('databse-error'))
            <div class="alert alert-danger">
                {{ session()->get('database-error') }}

            </div>
            <?php session()->forget('database-error'); ?>
        @endif

    </div>
    
    <div class="p-5 text-center bg-body-tertiary">
        <h1 class="mb-3">Your Products</h1>


    </div>
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container">
            <div class="row justify-content-center">
                @if (!$products->isEmpty())

                    @foreach ($products as $product)
                        <div class="col-lg-12 m-4">
                            <div class="card bg-light p-2" style="border-radius: 15px; ">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="bg-image  hover-overlay">
                                                <img src="{{ asset('storage/images/products/' . $id . '/' . $product->image) }}"
                                                    class="img-fluid"
                                                    style="border-top-left-radius: 15px; border-bottom-right-radius:15px; border-top-right-radius: 15px; border-bottom-left-radius: 15px; margin-right: 4px;" />

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">{{ $product->description }}</p>
                                                <p class="card-text">Rs.{{ $product->price }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="card-body">

                                                <div class="d-flex justify-content-center m-2">
                                                    <form method="get"
                                                        action="{{ route('customer.product.edit-form', ['id' => $product->product_id]) }}">
                                                        @csrf
                                                        <button class="btn btn-info" type="submit">Update</button>
                                                    </form>
                                                </div>

                                                <div class="d-flex justify-content-center m-2">
                                                    <form method="get"
                                                        action="{{ route('customer.product.destroy', ['id' => $product->product_id]) }}">
                                                        @csrf
                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h5>You dont have products to view yet.</h5>

                @endif
            </div>
        </div>
    </div>
@else
    <div class="p-5 text-center bg-body-tertiary">
        <h1 class="mb-3">You have to login to the system first to view products.</h1>
    </div>

@endif
