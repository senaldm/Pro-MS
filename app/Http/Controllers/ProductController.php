<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        //find specific users' products
        if(Auth::user()->id==$id)
        {
        try {

            $products = Product::where('owner_id', $id)->get();
            if($products->count()>0){
                return view('product/products', compact('products'));
            }
            else {
                return view('product/products')->with('message','Opps! You don\'t have any products yet. Add products to view');
            }

        } catch (\Throwable) {

            return back()->withErrors('Error','Opps! An Unexpected Error.Please try again');
        }
    }
    else {
        return back()->withErrors('Error','Sorry! You are not permitted with this user ID.');
    }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'name'=>['required','string'],
            'description'=>'required',
            'price'=>'required',
            'image' => ['required','image','mimes:jpg,jpeg,png'],
        ]);

        $validatorErrorMessage = [
            'name.required'=>'Product name field is required.',
            'name.string'=>'Product name should be string.',
            'description.required'=>'Product description field is required.',
            'price.required'=>'Product price field is required.',
            'image.required'=>'Product image is required.',
            'image.image'=>'Product image should be an image.',
            'image.mimes'=>'Only acceptable image types are jpg, jpeg and png .',
        ];

        $validator->setCustomMessages($validatorErrorMessage);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        try {

            $directory = '/public/product/' . Auth::user()->id;

            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory, 0755, true);
            }

            $imagePath = $request->file('image')->storeAs(
                $directory,
                $request->file('image')->hashName()
            );

            $product = Product::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'image' => $imagePath,
            ]);

            $products=Product::where('customer_id',Auth::user()->id)->get();
            if($product){
                return view('customer/product',compact('products'))->with('success','New product has been created.');
            }
            else {
                return back()->withErrors('Error', 'Sorry! We are unable to store the product. Try again');
            }

        } 
        
        catch (\Throwable) {
            
            return back()->withErrors('error', 'Opps!! An unexpected error occurs.Try again');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
        
            $product = Product::where('product_id', $id)->get();
            if ($product->count()>0) {
                return view('product.show-product', compact('product'));
            }
            else {
                return back()->withErrors('error','Sorry! Couldn\'t find the product. Try again. ');
            }
           
        } 
        
        catch (\Throwable ) {
            return back()->withErrors('Error','An Unexpected error occurs. try again.');
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::findByID($id);
        return view('customer/edit-product',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $existImage)
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

            $directory = '/public/product/' . Auth::user()->id;

            Storage::delete($existImage);
            $imagePath = $request->file('image')->storeAs(
                $directory,
                $request->file('image')->hashName()
            );

            $product = Product::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'image' => $imagePath,
            ]);

            $products = Product::where('customer_id', Auth::user()->id)->get();
            if ($product) {
                return view('customer/product', compact('products'))->with('success','Product has been updated successfully.');
            } else {
                return back()->withErrors('Error', 'Sorry! We are unable to update the product. Try again');
            }
        } catch (\Throwable) {

            return back()->withErrors('error', 'Opps!! An unexpected error occurs.Try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                $product->delete();
                $products = Product::where('owner_id', Auth::user()->id)->get();
                return view('product/products', compact('products'));
        
            
        }
        else {
            return back()->withErrors('message','Sorry! We couldn\'t to remove the value. Try again');
        }
    }
         catch (\Throwable ) {
            return back()->withErrors('error', 'Opps!! An unexpected error occurs.');
        }
     
    }
}
