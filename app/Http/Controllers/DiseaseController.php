<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disease;
use Illuminate\Support\Facades\Validator;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diseases = Disease::paginate(5);
        return response()->json(['info'=>$diseases],200);
    }
    public function indexNoPaging()
    {
        $diseases = Disease::all();
        return response()->json(['info'=>$diseases],200);
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
            'specie_id'=>'required|exists:species,id'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $disease = Disease::create($request->all());
        return response()->json(['data'=>$disease],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disease = Disease::findOrFail($id);
        return response()->json(['data'=>$disease],200);
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
        $disease =  Disease::findOrFail($id);
        $validationRules = [
            'name'=>'required|min:2',
            'information'=>'required|min:2',
            'specie_id'=>'required|exists:species,id',

        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }

        $disease->name = $request->name;
        $disease->information = $request->information;
        $disease->specie_id = $request->specie_id;
        $disease->save();

        return response()->json(['data'=>$disease],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disease =  Disease::findOrFail($id);
        $disease->delete();        
        return response()->json(['data'=>$disease],200);
    }
}
