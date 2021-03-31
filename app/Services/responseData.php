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

Class responseData {

     public function __construct($foo = null)
    {
        $this->driver = new ExistingClass();
     
    }
    
    public function validatorRegistration(){

    $data = [

            'username'       => 'required',
            'mobile_number'  => 'required',
            'location'       => 'required',
            'password'       => 'required',
        ];

        return $data;

    }

    public function ISEXIST($MSG='',$OBJECT=array()){

        return response()->json([
                   'status'       => Controller::HTTP_BAD_REQUEST,
                   'message'      => $MSG,
                   'responseData' => (object) []
                ]);
    }

    public function objectHTTPOK($MSG='',$data=array()){

        return response()->json([
                   'status'       => Controller::HTTP_OK,
                   'message'      => $MSG,
                   'responseData' => $data
                ]);
    }

    public function arrayHTTPOK($MSG='',$data=array()){

        return response()->json([
                   'status'        => Controller::HTTP_OK,
                   'message'       => $MSG,
                   'responseData'  => $data
                ]);
    }

    public function httpbadREQUEST($MSG='',$data=array()){

        return response()->json([
                   'status'        => Controller::HTTP_BAD_REQUEST,
                   'message'       => $MSG,
                   'responseData'  => (object) []
                ]);
    }

    

}