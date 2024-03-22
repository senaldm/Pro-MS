<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{


    //for view the login page
    public function showLoginPage(){
        return view('user/login');
    }



    // for view the register page
    public function showRegisterForm(){
        return view('user/register');
    }


    //for user login to the system
    public function login(Request $request){
        $credentials=$request->only('email','password');

        try {
            if(Auth::attempt($credentials)){

                return redirect()->route('customer.dashboard');
            }
            else {
                if (!Auth::attempt(['email' => $request->email])) {
                    
                    return back()->withErrors(['email'=>'Your Email is incorrect. Try again with correct email or register']);
                    
                }
                else if (!Auth::attempt(['password' => $request->password])) {
                    
                   return back()->withErrors(['password'=>'Your password is incorrect. Check again']);
                }
                
            }
 
        } catch (\Throwable) {
             session()->put('database-error','Unexpected Error. Try again to register');
           return back();
        }
    }



    //for user registration
    public function store(Request $request)
    {
        
        $validator=Validator::make($request->all(),[
            'name'=>['required','string','max:255'],
            'email'=>['required','email','unique:users,email'],
            'contact_no'=>['required','numeric'],
            'password'=>['required','confirmed','min:8','regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/',],
            

    ]);

    $validationFailsError=[
        'name.required'=>'Name field is required.',
        'name.string'=>'Name must be a string.',
        'name.max'=>'Maximum allocation for name is 255 characters only.',
        'email.required'=>'Email field is required.',
        'email.email'=>'Email must be a valid email address.',
        'email.unique'=>'This email has already in the system. If you are already registered, please login.',
        'contact_no.required'=>'Contact field is required.',
        'contact_no.numeric'=>'contact should be numeric not string',
        'password.required'=>'Password field is required.',
        'password.confirmed'=>'Password and Confirm password must be same.',
        'password.min'=>'Password must contain at least 8 characters',
        'password.regex'=>'Password must contain at least one lowercase letter, one uppercase letter and one number',
        

    ];

    $validator->setCustomMessages($validationFailsError);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
        
    }

    try {
            $userData = $request->all();

             $userData['password'] = Hash::make($userData['password']);

            $user=User::create($userData);

            Auth::login($user);
        
            return redirect()->route('customer.dashboard');
            
    }
     catch (\Throwable) {

        session()->put('database-error','Unexpected Error. Try again to register');
        return back()->withInput();
    }

    }



    //for logout the user
    public function logout() {
       
        session()->flush();

        Auth::logout();
        
        return redirect()->route('user.login.form');
    }
}
