<?php

namespace App\Http\Controllers\Customer;

use App\Customers;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $customers = Customers::all();
        return response()->json([ 'msg'=> 'Customers Data Retrieved successfully', 'data'=> CustomerResource::collection($customers), 'status_code'=> 200]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
       $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email'      => 'required|email',
            'utr'        => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'Validation Error', 'status_code'=> 201]);
        }

        $customer = Customers::create($data);

        return response()->json(['msg'=> 'Created successfully.', 'data'=> new CustomerResource($customer), 'status_code'=> 200]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $customer = Customers::find($id);
        if (is_null($customer)) {
            return response()->json(['msg'=>'Data not found', 'status_code'=> 404 ]);
        }
        return response()->json(['data' => new CustomerResource($customer), 'status_code'=> 200]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email'      => 'required|email',
            'utr'        => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'Validation Error','status_code'=> 201] );
        }

        $customer = Customers::find($id);
        $customer->update($data);

        return response()->json(['msg'=> 'Customer Data Update successfully.', 'data'=> new CustomerResource($customer), 'status_code'=> 200 ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // delete
        $customer = Customers::find($id);
        if (is_null($customer)) {
            return response()->json(["msg" =>'Data not found', 'status_code'=> 404 ]);
        }
        $customer->delete();
        return response()->json(["msg" => 'Customer deleted successfully', 'status_code'=> 200]);
    }
}
