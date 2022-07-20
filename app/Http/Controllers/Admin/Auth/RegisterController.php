<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Permission;
use App\Mail\AdminMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin',['except'=>['create','showRegistrationForm','register']]);
    }

    public function showRegistrationForm()
    {
        $permissions = Permission::all();
        return view('admin.auth.register',compact('permissions'));
    }

    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Admin
     */
    protected function create(Request $request, Admin $admin)
    {  
        $this->validator($request->all())->validate();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request['password']);
        $admin->role = Auth::user()->superAdmin() ? $request->role : 'admin';
        $admin->save();
        $admin->permissions()->attach($request->names);
 
        
        $data = array(
            'admin' =>  Auth::user()->name,
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'password' =>  $request->password,
            'role' =>  Auth::user()->superAdmin() ? $request->role : 'admin',  
        );
        if ($admin) {

            Mail::to($request['email'])->send(new AdminMail($data));
 
            return redirect('/admin')->with('message', (Auth::user()->superAdmin() ? ucfirst($request->role) : 'Admin').' has been registered successfully.');
        }
        else{
            return redirect()->back()->with('error','Some error is occured.');
        }
    }
}
