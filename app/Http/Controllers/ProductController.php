<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
   
// Show the form for creating a new resource.

    public function create()
    { 
        if (Auth::check()) {
          return view('product/addProduct');
        }

        else {
            
            return redirect()->route('user.login.form');
        }
        
    }

// Store a newly created resource in storage.

    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'name'=>['required','string'],
            'description'=>'required',
            'price'=>'required',
            'image' => ['required','mimes:jpg,jpeg,png'],
        ]);

        $validatorErrorMessage = [
            'name.required'=>'Product name field is required.',
            'name.string'=>'Product name should be string.',
            'description.required'=>'Product description field is required.',
            'price.required'=>'Product price field is required.',
            'image.required'=>'Product image is required.',
            'image.mimes'=>'Only acceptable image types are jpg, jpeg and png .',
        ];

        $validator->setCustomMessages($validatorErrorMessage);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        
        try {

            $directory =  Auth::user()->id;

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->storeAs('/public/images/products/'.$directory,$imageName);
            

            $product = Product::create([
                'name' => $request->input('name'),
                'owner_id'=>Auth::user()->id,
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'image' => $imageName,
            ]);

            if($product){

                session()->put('store-success','Product entered successfully.');

                return redirect()->route('customer.dashboard');
            }


            else {
                session()->put('store-Error', 'Sorry! We are unable to store the product. Try again');

                return back();
            }

        } 
        
        catch (\Throwable) {

            session()->put('database-error','Uncaughted Error. Try again.');

            return back();
        }
         
    }


   
// Show the form for editing the specified resource.

    public function edit($id)
    {
        $product=Product::find($id);
        return view('product/updateProduct',compact('product'));
    }



    // Update the specified resource in storage.

    public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => 'required',
            'price' => 'required',
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        $validatorErrorMessage = [
            'name.required' => 'Product name field is required.',
            'name.string' => 'Product name should be string.',
            'description.required' => 'Product description field is required.',
            'price.required' => 'Product price field is required.',
            'image.required' => 'Product image is required.',
            'image.image' => 'Product image should be an image.',
            'image.mimes' => 'Only acceptable image types are jpg, jpeg and png .',
        ];

        $validator->setCustomMessages($validatorErrorMessage);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
          
            //find the existing image and delete it to save storage

            $product=Product::find($id);
            $existImage=$product->image;
            $directory = '/public/images/products/'.Auth::user()->id;

            $success=Storage::delete($directory.'/'.$existImage);

            //save new image on storage
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs($directory,$imageName);
            
            
            $productData=$request->all();
            $productData['image']=$imageName;

            $update=$product->update($productData);

            $products = Product::where('owner_id', Auth::user()->id)->get();


            if ($update) {

                 session()->put('update-success','Your product update successfully.');

                return view('customer/dashboard', compact('products'));
            } 
            
            
            else {

                session()->put('update-error','Sorry! couldn\'t to update the product details. Try again.');
                return back();
            }


        } 
        
        catch (\Throwable) {
     
             session()->put('database-error','Uncaughted Error. Try again.');
            return back();
        }
    }



// Remove the specified resource from storage.

    public function destroy($id)
    {


        try {
            $product=Product::find($id);
            if ($product) {
                $product->delete();
                session()->put('delete-success','Your product is deleted successfully.');
                $products = Product::where('owner_id', Auth::user()->id)->get();
                return view('customer/dashboard', compact('products'));
                
            
        }
        else {
            session()->put('delete-error','Your product is already deleted');

            return back();
        }
    }
         catch (\Throwable) {
    
            session()->put('database-error','Opps!! An unexpected error occurs. Try again.');
            return back();
        }
     
    }
}
