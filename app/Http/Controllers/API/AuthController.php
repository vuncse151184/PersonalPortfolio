<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // public function index()
    // {
    //     $users = DB::table('users')->select('id','email')->get();

    //     return view('some-view')->with('users', $users);
    // }

    public function register(Request $request){
        //validator
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same: password'
        ]);

        if($validator->fails()){
            $response = [
                'success'=>false,
                'message'=>$validator->error()
            ];
            return response()->json_decode($response,400);
        }

        $input= $request->all();
        $input['password']=bcrypt($input['password']);
        $user = User::create($input);

        $success['token']= $user->createToken('MyApp')->plainTextToken;
        $success['name']=$user->name;

        $response = [
            'success'=> true,
            'data' => $success,
            'message'=>'User register successfully'
        ];

        return response()->json($response,200);
    }

    public function login(Request $request){
        // echo('encrypted-pass:'.bcrypt($request->password));
        if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
                $user = $request->user();
                $success['token']=$user->createToken('MyApp')->plainTextToken;
                $success['name']=$user->name;
                $response=[
                    'success'=>true,
                    'data'=>$success,
                    'message'=>'User login successfully'
                ];

            return response()->json($response,200);

        }else{

            return response()->json([
                'success'=>false,
                'message'=>'Unauthoriezed'
            ]);
        }
    }

}
