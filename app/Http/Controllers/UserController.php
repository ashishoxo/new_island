<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $authUser = \Auth::user();

        return view('profile')->with(['authUser'=>$authUser]);
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
}
