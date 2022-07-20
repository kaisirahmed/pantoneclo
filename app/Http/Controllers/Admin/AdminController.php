<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Mail\AdminMail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        return view('admin.index.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->superAdmin()) {
            $admins = Admin::all()->sortByDesc('created_at');
        }else{
            $admins = Admin::all()->where('role','!=','superAdmin')->sortByDesc('created_at');
        }
        
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', 'string'],
        ]);

        if ($validator->fails()) {  
            return redirect()->back()->withErrors($validator);
        }else{
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->role = $request->role;
            $admin->save();

            $data = array(
                'admin' =>  Auth::user()->name,
                'name'  =>  $request->name,
                'email' =>  $request->email,
                'role' =>  Auth::user()->superAdmin() ? $request->role : 'admin',  
            );

            Mail::to($request['email'])->send(new AdminMail($data));

            return redirect('/admin')->with('message',ucfirst($admin->role).' updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->destroy($admin->id);

        return redirect('/admin')->with(['message'=>'Author has been deleted successfully.']);
    }
}
