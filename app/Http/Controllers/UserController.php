<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile()
    {
        $authUser = \Auth::user();

        return view('profile')->with(['authUser'=>$authUser]);
    }

    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_no' => 'required',
            'password' => 'confirmed',
            // 'password_confirmation' => 'required_with:password'
        ]);
 
        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->password == null) {
            \Auth::user()->update($request->except('password'));
        }else{
            \Auth::user()->update($request->all());
        }
        
        // dd(\Auth::user());
        return \Redirect::back()->with('message', 'Profile has been updated!');;
    }

    public function addresses()
    {
        $addresses = \Auth::user()->addresses;

        return view('addresses')->with(['addresses'=>$addresses]);
    }

    public function addressStore(Request $request)
    {

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['is_default'] = 0;

        $address = Address::create($data);

        return redirect()->back()->with('message', 'Address has been added!');
    }

    public function makeAddressDefault(Request $request)
    {
        \Auth::user()->addresses()->update(["is_default"=>0]);

        Address::where('id',$request->address_id)->update(["is_default"=>1]);

        return redirect()->back()->with('message', 'Default address changed!');       
    }

    public function index()
    {
        $users = User::all();
        // dd($products);
        return view('admin.users.list')->with(['users'=>$users]);
    }

    public function edit(User $user)
    {
       
        return view('admin.users.edit')->with(['user'=>$user]);
    }

    public function create()
    {
        return view('admin.users.add');
    }
}
