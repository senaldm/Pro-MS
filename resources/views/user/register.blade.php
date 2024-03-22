
@extends('user.base')


<div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card bg-light mt-5 mb-5" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>


              <form method="POST" action="{{route('user.registration')}}">
                @csrf
                <div class="form-outline mb-4">
                    <input type="text" id="name" name ="name" class="form-control form-control-lg"  value="{{ old('name') }}" />
                    <label class="form-label" for="name" ><span class="text-danger">*</span>Full Name</label>
                   
                </div>


                <div class="form-outline mb-4">
                    <input type="text" id="email" name="email" class="form-control form-control-lg"  value="{{ old('email') }}" />
                    <label class="form-label" for="email"><span class="text-danger">*</span>Email Address</label>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-outline mb-4">
                  <input type="text" id="contact_no" name="contact_no" class="form-control form-control-lg" value="{{ old('contact_no') }}"/>
                  <label class="form-label" for="contact_no"><span class="text-danger">*</span>Contact No</label>
                  @error('contact_no')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-outline mb-4">
                  <input type="password" id="password" name="password" class="form-control form-control-lg" value="{{ old('password') }}"  />
                  <label class="form-label" for="passowrd"><span class="text-danger">*</span>Password</label>
                  @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-outline mb-4">
                  <input type="password" id="confirm-password" name="password_confirmation" class="form-control form-control-lg" value="{{ old('password_confirmation') }}" />
                  <label class="form-label" for="confirm_password"><span class="text-danger">*</span>Confirm Password</label>
                </div>


                <div class="form-outline mb-0">
                <p class="text-left text-bolt mt-0 mb-4">Fields with <span class="text-danger">*</span> are required fields</p>
                </div>


                 <div class="d-flex justify-content-center">
                  <button type="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>


                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="{{route('user.login.form')}}"
                    class="fw-bold text-body"><u>Login here</u></a></p>
                      </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
                

