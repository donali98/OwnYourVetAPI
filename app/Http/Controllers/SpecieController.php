<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specie;
use Illuminate\Support\Facades\Validator;

class SpecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $species = Specie::all();
        return response()->json(['data'=>$species],200);
        
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
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $specie = Specie::create($request->all());
        return response()->json(['data'=>$specie],200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specie = Specie::findOrFail($id);
        return response()->json(['data'=>$specie],200);
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
        $specie = Specie::findOrFail($id);
        $validationRules = [
            'name'=>'required|min:2',
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $specie->name = $request->name;
        $specie->save();
        return response()->json(['data'=>$specie],200);


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specie = Specie::findOrFail($id);
        $specie->delete();
        
        return response()->json(['data'=>$specie],200);
    }
}
