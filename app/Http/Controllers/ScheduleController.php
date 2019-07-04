<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\User;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = Schedule::with('user')->get();
        return response()->json(['data'=>$schedule],200);
    }

    public function getSchedulesOfUser($id)
    {
        $schedule = Schedule::with('user')
        ->where('id_user','=',$id)
        ->get();
        return response()->json(['data'=>$schedule],200);

        
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
            'day'=>'required|date_format:Y-m-d|unique:schedules,day',
            'id_user'=>'required|exists:users,id'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $user = User::findOrFail($request->id_user);
        if(!$user->isAdmin()) return response()->json(['data'=>"El usuario que se desea ingresar no es medico"],400);
        $schedule = Schedule::create($request->all());
        return response()->json(['data'=>$schedule],200);           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return response()->json(['data'=>$schedule],200);
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
        $schedule = Schedule::findOrFail($id);
        $validationRules = [
            'day'=>'required|date|unique:schedules,day',
            'id_user'=>'required|exists:users,id'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $user = User::findOrFail($request->id_user);
        if(!$user->isAdmin()) return response()->json(['data'=>"El usuario que se desea ingresar no es medico"],400);
        $schedule->day = $request->day;
        $schedule->id_user = $request->id_user;
        $schedule->save();
        return response()->json(['data'=>$schedule],200);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule =  Schedule::findOrFail($id);
        $schedule->delete();       
        return response()->json(['data'=>$schedule],200);
    }
}
