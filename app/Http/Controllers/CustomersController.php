<?php

namespace App\Http\Controllers;

use App\Customers;
use Illuminate\Http\Request;
use Validator;


class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customers::all();
        return response()->json(['success' => true, 'data'=> [ 'customers' => $customers ]], 200);
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
        $credentials = $request->only('name', 'email', 'number');
        // return $request->toArray();
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'number' => 'required|max:13|unique:customers'
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
        $name = $request->name;
        $email = $request->email;
        $number = $request->number;

        $user = Customers::create(['name' => $name, 'email' => $email, 'number' => $number]);

        return response()->json(['success'=> true, 'message'=> 'Customer added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show($customer)
    {
        try {
            $customer = Customers::where('id',$customer)->first();

            if(!$customer){

                return response()->json(['success'=> false, 'message'=> 'Requested user not found']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=> false, 'message'=> 'oops! Something went wrong plese try again']);
        }

        return response()->json(['success' => true, 'data'=> [ 'customer' => $customer ]], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $credentials = $request->only('name');
        $rules = [
            'name' => 'required|max:255',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
        $name = $request->name;

        $customer = Customers::where('id',$id)->first();
        if($customer){
            $customer->update(['name' => $name]);
            return response()->json(['success'=> true, 'message'=> 'Customer Upadated']);
        }else{
            return response()->json(['success'=> false, 'message'=> 'Requested user not found']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $customer =  Customers::where('id', $id)->first();
            if ($customer) {
                $customer->delete();
            }
            else{
                return response()->json(['success'=> false, 'message'=> 'User not available']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=> false, 'message'=> 'Something went wrong, please try again']);

        }
        return response()->json(['success'=> true, 'message'=> 'Customer Deleted']);


    }
}
