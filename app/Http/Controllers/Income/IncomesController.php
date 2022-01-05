<?php

namespace App\Http\Controllers\Income;

use App\Http\Controllers\Controller;
use App\Http\Resources\IncomeResource;
use App\Incomes;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $incomes = Incomes::all();
        return response()->json([ "msg" => 'Incomes Data Retrieved successfully', 'data'=>  IncomeResource::collection($incomes), 'status_code'=> 200]);
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
            'customer_id' => 'required|integer',
            'description'      => 'required',
            'amount'            => 'required|numeric',
            'income_date'        => 'required|date_format:Y-m-d',
            'tax_year'          => 'required|min:1900|max:'.date("Y"),
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'Validation Error', 'status_code'=> 201]);
        }


        if($request->file()) {
            $request->validate([
                'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:4096'
            ]);

            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('app/public', $fileName, 'public');


            $income_file_path = '/storage/' . $filePath;
            $data["income_file_path"] = $income_file_path;
        }

        $incomes = Incomes::create($data);

        return response()->json([ 'msg'=> 'Customer Income Data Created successfully.', 'data'=> new IncomeResource($incomes), 'status_code'=> 200]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $income = Incomes::find($id);
        if (is_null($income)) {
            return response()->json(['msg'=>'Data not found', 'status_code'=> 404] );
        }
        return response()->json(['data'=> new IncomeResource($income), 'status_code'=> 200]);
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
            'customer_id' => 'required|integer',
            'description'      => 'required',
            'amount'            => 'required|numeric',
            'income_date'        => 'required|date_format:Y-m-d',
            'tax_year'          => 'required|min:1900|max:'.date("Y"),
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'Validation Error',  'status_code'=> 201]);
        }

        if($request->file()) {
            $request->validate([
                'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:4096'
            ]);

            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('app/public', $fileName, 'public');


            $income_file_path = '/storage/' . $filePath;
            $data["income_file_path"] = $income_file_path;
        }

        $incomes = Incomes::find($id);
        $incomes->update($data);
        return response()->json([ "msg" => 'Customer Income Data Update successfully.', 'data'=> new IncomeResource($incomes), 'status_code'=> 200]);
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
        $income = Incomes::find($id);
        if (is_null($income)) {
            return response()->json(['msg'=> 'Data not found', 'status_code'=> 404 ] );
        }
        $income->delete();
        return response()->json(["msg" => 'Customer Income Data Deleted successfully', 'status_code'=> 200] );
    }
}
