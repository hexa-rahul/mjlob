<?php

namespace App\Services;

use DB;
use File;
use DateTime;
use App\Models\User;  
use App\Services\ExistingClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Validator;

Class ExistingClass {

	public function isNumberisUniqe($mobile_number=''){
    	
    	$existNumber = User::where('mobile_number', $mobile_number)->count();
    	if($existNumber>0){
        	
        	return true;
    	}else{

    		return false;
    	}
	}

	public function profileUpdateMobileNumber($table, $user_id='',$mobile_number=''){
    	
    	$existNumber = User::where('id', '!=', $user_id)
    	                   ->where('mobileNo', $mobile_number)->count();
    	
    	if($existNumber>0){
        	
        	return true;
    	}else{

    		return false;
    	}
	}

	public function isEmailisUniqe($email_address=''){
    	
    	$existEmail = User::where('email', $email_address)->count();
    	if($existEmail>0){
        	
        	return true;
    	}else{

    		return false;
    	}
	}

	public function profileUpdateEmail($user_id='',$email_address=''){
    	
    	$existEmail = User::where('id', '!=', $user_id)
    	                   ->where('email', $email_address)->count();
    	
    	if($existEmail>0){
        	
        	return true;
    	}else{

    		return false;
    	}
	}

    public function isUsernameisUniqe($username=''){
        
        $existUsername = User::where('username', $username)->count();
        if($existUsername>0){
            
            return true;
        }else{

            return false;
        }
    }

    public function registration($data=array()){

        $validator = Validator::make($data, [

            'username'       => 'required',
            'mobile_number'  => 'required',
            'location'       => 'required',
            'password'       => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
//return $data['username'];


        $username          = $data['username'];
        $mobile_number     = $data['mobile_number'];
        $location          = $data['location'];
        $password          = $data['password'];
        $otp               = substr(str_shuffle("0123456789"), 0, 4);

       if($this->isNumberisUniqe($mobile_number) == true){
        
           return response()->json([
               'status'    => Controller::HTTP_BAD_REQUEST,
               'message'   => trans('lang.mobile_already_exist'),
               'object'    => (object) []
           ]);
        }

        if($this->isUsernameisUniqe($mobile_number) == true){
        
           return response()->json([
               'status'    => Controller::HTTP_BAD_REQUEST,
               'message'   => trans('lang.mobile_already_exist'),
               'object'    => (object) []
           ]);
        }

        $input             = $data;
         $input['password'] = bcrypt($input['password']);
        $input['otp']      = $otp;
         $user              = array();
        
         $user = User::create($input);
       $success['token'] = $user->createToken('MyApp')->accessToken;



        $inserted_user_id = $user->id;

     
        
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.registration_msg'),
            'data' =>  $user,

        ]);
    }

}