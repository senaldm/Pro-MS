<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(Auth::check())
     
        {
         
        try {
            $id=Auth::user()->id;
            $products = Product::where('owner_id', $id)->get();
      
            return view('customer/dashboard', compact('products'));
            
        } catch (\Throwable) {

             session()->put('database-error','Opps! An Unexpected Error.Please try again');
            return back();
        }
    }


    else {
        $products=[[]];
        return view('customer/dashboard',compact('products'));
    }
        
    }

   
}
