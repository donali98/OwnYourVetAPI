<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Race;
use Illuminate\Support\Facades\Validator;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $races = Race::all();
        return response()->json(['data'=>$races],200);
    
    }
    public function getRacesFromSpecie($id)
    {
        $race  = Race::with('specie')->where('specie_id','=',$id)->get();
        return response()->json(['data'=>$race],200);

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
            'specie_id'=>'required|exists:species,id'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $params = $request->all();
        $race = Race::create($params);
        return response()->json($race,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $race = Race::findOrFail($id);
        return response()->json(['data'=>$race],200);
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
        $race = Race::findOrFail($id);

        $validationRules = [
            'name'=>'required|min:2',
            'specie_id'=>'required|exists:species,id'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $race->name = $request->name;
        $race->specie_id = $request->specie_id;

        $race->save();
        return response()->json(['data'=>$race],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $race = Race::findOrFail($id);
        $race->delete();
        
        return response()->json(['data'=>$race],200);
    }
}
