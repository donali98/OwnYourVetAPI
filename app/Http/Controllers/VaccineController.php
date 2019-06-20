<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vaccine;
use Illuminate\Support\Facades\Validator;

class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaccines = Vaccine::all();
        return response()->json(['data'=>$vaccines],200);
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
            'information'=>'required|min:2',
            'specie_id'=>'required|exists:species,id',

        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $vaccine = Vaccine::create($request->all());
        return response()->json(['data'=>$vaccine],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vaccine = Vaccine::findOrFail($id);
        return response()->json(['data'=>$vaccine],200);

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
        $vaccine =  Vaccine::findOrFail($id);
        $validationRules = [
            'name'=>'required|min:2',
            'information'=>'required|min:2',
            'specie_id'=>'required|exists:species,id',

        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }

        $vaccine->name = $request->name;
        $vaccine->information = $request->information;
        $vaccine->specie_id = $request->specie_id;
        $vaccine->save();

        return response()->json(['data'=>$vaccine],200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vaccine =  Vaccine::findOrFail($id);
        $vaccine->delete();        
        return response()->json(['data'=>$vaccine],200);

    }
}
