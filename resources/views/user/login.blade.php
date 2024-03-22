@extends('user.base')



<div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6 ">
          <div class="card  bg-light mt-5 mb-4 " style="border-radius: 15px;">
            <div class="card-body p-5 ">
              <h2 class="text-uppercase text-center mb-5">Login</h2>

                <form method="POST" action="{{route('user.login')}}">
                  @csrf
                  <div class="form-outline mb-4">
                      <input type="email" id="email" name="email" class="form-control" />
                      <label class="form-label" for="email">Email address</label>
                      @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control form-control-lg" value="{{ old('password') }}"  />
                    <label class="form-label" for="passowrd">Password</label>
                    @error('password')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4">Sign in</button>
                  </div>
                    <p class="text-center text-muted mt-5 mb-0">Not a member?  <a href="{{route('user.register.form')}}"
                      class="fw-bold text-body"><u>Register</u></a></p>
                </form>
          
          
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

