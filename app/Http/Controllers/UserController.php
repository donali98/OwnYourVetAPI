<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = User::all();
        return response()->json(['data'=>$user],200);
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
            'id'=>'required|unique:users',
            'email'=>'required|email',
            'user_type'=>'required|in:1,0',
            'names'=>'min:2|max:20',
            'direction'=>'min:2|max:1000'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $user = User::create($request->all());
        return response()->json(['data'=>$user],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['data'=>$user],200);
    }

    public function findAdmins()
    {
        $users = User::where('user_type',User::USUARIO_ADMIN)->get();
        return response()->json(['data'=>$users],200);
    }

    public function findNormal()
    {
        $users = User::where('user_type',User::USUARIO_NORMAL)->get();
        return response()->json(['data'=>$users],200);
    }
    
    public function getAdminsByEmail(Request $request){
        $validationRules = ['email'=>'required'];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails())  return response()->json(['error'=>$validator->errors()],400);
        $users = User::where('email','like','%'.$request->email.'%')
        ->where('user_type',User::USUARIO_ADMIN)
        ->get();
        return response()->json(['data'=>$users],200);

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
        $user = User::findOrFail($id);
        $validationRules = [
            'names'=>'min:2|max:20',
            'direction'=>'min:2|max:1000'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $user->names = $request->names;
        $user->direction = $request->direction;
        $user->save();
        return response()->json(['data'=>$user],200);

        
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  User::findOrFail($id);
        $user->delete();        
        return response()->json(['data'=>$user],200);
    }
}
