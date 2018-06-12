<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\VerifyUser;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Mail;

class UserController extends Controller {

    public $successStatus = 200;
    
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 

            if ($user->verified) {
                $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                return response()->json(['success' => $success], $this-> successStatus); 
            } else {
                return response()->json(['warning' => 'You need to confirm your account. We have sent you an activation code, please check your email.'], $this-> successStatus);
            }
        } 
        else{ 
            return response()->json(['error'=>'Unauthorized'], 401); 
        } 
    }

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        //$success['token'] =  $user->createToken('MyApp')-> accessToken; 
        //$success['name'] =  $user->name;

        Mail::to($user->email)->send(new VerifyMail($user));

        return response()->json(['success'=>'We sent you an activation code. Check your email and click on the link to verify.'], $this-> successStatus); 
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}
