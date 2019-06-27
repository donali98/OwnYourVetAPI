<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::with('race')->get();
        return response()->json(['data'=>$patients],200);
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
            'name'=>'required|min:2',
            'race_id'=>'required|exists:races,id'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $patient = Patient::create($request->all());
        return response()->json(['data'=>$patient],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::with('race')->findOrFail($id);
        return response()->json(['data'=>$patient],200);

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
        $patient =  Patient::with('race')->findOrFail($id);
        $validationRules = [
            'name'=>'required|min:2',
            'race_id'=>'required|exists:races,id'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }

        $patient->name = $request->name;
        $patient->race_id = $request->race_id;
        $patient->save();

        return response()->json(['data'=>$patient],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient =  Patient::with('race')->findOrFail($id);
        $patient->delete();        
        return response()->json(['data'=>$patient],200);
    }
}
