<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientPatient;
use Illuminate\Support\Facades\Validator;

class ClientPatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientClientPatients = ClientPatient::with(['client','patient'])->get();
        return response()->json(['data'=>$clientClientPatients],200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationRules = [
            'client_id'=>'required|exists:users,id',
            'patient_id'=>'required|exists:patients,id'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $clientClientPatient = ClientPatient::create($request->all());
        return response()->json(['data'=>$clientClientPatient],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientClientPatient = ClientPatient::with(['client','patient'])->findOrFail($id);
        return response()->json(['data'=>$clientClientPatient],200);

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clientClientPatient = ClientPatient::with(['client','patient'])->findOrFail($id);
        $validationRules = [
            'client_id'=>'required|exists:users,id',
            'patient_id'=>'required|exists:patients,id'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }

        $clientClientPatient->name = $request->name;
        $clientClientPatient->race_id = $request->race_id;
        $clientClientPatient->save();

        return response()->json(['data'=>$clientClientPatient],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clientClientPatient = ClientPatient::with(['client','patient'])->findOrFail($id);
        $clientClientPatient->delete();        
        return response()->json(['data'=>$clientClientPatient],200);
    }
}
