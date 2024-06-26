
@extends('user.base')

<nav class="navbar navbar-expand-lg navbar-light bg-dark bg-body-tertiary">
 
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <p class="navbar-brand mb-2 mb-lg-2 mr-5 text-white" >
                Pro-MS
            </p>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
                <li class="nav-item">
                <a class="nav-link text-white" href="{{route('customer.dashboard')}}">Dashboard</a>
                </li>
                @if(Auth::check())
                <li class="nav-item">
                
                <a class="nav-link text-white" href="{{route('customer.product.create-form')}}">Create Product</a>
                
             
                </li>
                   @else
                     <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('user.login.form')}}">Create Product</a>
                    </li>
                
                @endif
              
            </ul>
        </div>

        <div class="d-flex align-items-right">
        
            <ul class="navbar-nav me-auto mb-2 ml-2 mb-sm-0">
            
                @if (Auth::check()){
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('user.logout')}}">logout</a>
                    </li>
                }
                @else{
                   <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('user.login.form')}}">login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('user.register.form')}}">Register</a>
                    </li>  
                }
                    
                @endif
                
            </ul>
        
        
        </div>
    </div>

    <div>
    
    </div>


</nav>

@yield('content')