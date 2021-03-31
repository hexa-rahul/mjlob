<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\responseData;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;

class LoginController extends Controller
{

    public function __construct(Request $request)
    {
        $this->responseData = new responseData();
        $local              = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : 'en';
        // set laravel localization
        app()->setLocale($local);
    }
    /*
    --------------------------------------------------------------------
    | LOGIN
    --------------------------------------------------------------------
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'login_type'     => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }

        
        $social_type   = ($request->social_type)?$request->social_type:'';
        $social_id     = ($request->social_id)?$request->social_id:'';

        
        if($request->login_type=='manual'){
            
            $validator = Validator::make($request->all(), [
                'mobile_number'  => 'required',
                'password'       => 'required',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();
                return $this->responseData->httpbadREQUEST(reset($errors)[0]);
            }
            $mobile_number = $request->mobile_number;
            $password      = $request->password;

            $data      = User::where(function ($q) use ($mobile_number, $password) {
                                    $q->where('mobile_number', $mobile_number);
                                })
                                ->orWhere(function ($q) use ($mobile_number, $password) {
                                    $q->where('mobile_number', $mobile_number);
                                })->first();

        }else if($request->login_type=='social'){
            $validator = Validator::make($request->all(), [
                'social_id'   => 'required',
                'social_type' => 'required',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();
                return $this->responseData->httpbadREQUEST(reset($errors)[0]);
            }

            $social_type   = ($request->social_type)?$request->social_type:'';
            $social_id     = ($request->social_id)?$request->social_id:'';

            $isRegister      = User::where(['social_id' => $social_id, 'social_type' => $social_type ])->count();
            if($isRegister>0){

                $data      = User::where(['social_id' => $social_id, 'social_type' => $social_type ])->first();
            }else{
                
                $inputData         = $request->all();
                $inputData['register_type'] = $request->login_type;
                $insertData        = User::create($inputData);
                $insertData->token = $insertData->createToken('MyApp')->accessToken;
                return $this->responseData->objectHTTPOK(trans('lang.login_success'),$insertData);
            }

        }else{

            return $this->responseData->httpbadREQUEST(trans('lang.error_msg'));
        }
        if(empty($data)) {

            return $this->responseData->httpbadREQUEST(trans('lang.not_register_user'));
        }
        
        if($request->login_type=='manual'){
            
            $checkPwd = Hash::check($request->password, $data->password);
            if ($checkPwd != 1) {
            
                return $this->responseData->httpbadREQUEST(trans('lang.pass_not_match'));
            }
        }
        
        $data->device_type  = ($request->device_type)?$request->device_type:'';
        $data->device_token = ($request->device_token)?$request->device_token:'';
        $data->latitude     = ($request->latitude)?$request->latitude:'';
        $data->longitude    = ($request->longitude)?$request->longitude:'';;
        $data->save();
        $data->token = $data->createToken('MyApp')->accessToken;

            return $this->responseData->objectHTTPOK(trans('lang.login_success'),$data);
    }
    //FOR CHECK USER BY MOBILE NUMBER
    public function checkUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile_number'  => 'required',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }
        
        $mobile_number     = $request->mobile_number;
       
        
        $data              = User::where(function ($q) use ($mobile_number) {
            $q->where('mobile_number', $mobile_number);
        }
        )->orWhere(function ($q) use ($mobile_number) {
            $q->where('mobile_number', $mobile_number);
            }
        )->first();
        
        if(empty($data)) {

            return $this->responseData->httpbadREQUEST(trans('lang.not_register_user'));
        }

        $response  = (object) []; 
        return $this->responseData->objectHTTPOK(trans('lang.success'),$response);
    }
    //FOR FORGOT PASSWORD
    public function verifyOtp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile_number'  => 'required',
            'otp'            => 'required',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }
        
        $mobile_number     = $request->mobile_number;
        $otp               = $request->otp;
        
        $data              = User::where(function ($q) use ($mobile_number, $otp) {
            $q->where('mobile_number', $mobile_number);
        }
        )->orWhere(function ($q) use ($mobile_number, $otp) {
            $q->where('mobile_number', $mobile_number);
            }
        )->first();
        
        if(empty($data)) {

            return $this->responseData->httpbadREQUEST(trans('lang.not_register_user'));
        }
        if($request->otp != $data->otp) {
        
            return $this->responseData->httpbadREQUEST(trans('lang.opt_not_match'));
        }
        
        $response  = (object) []; 
        return $this->responseData->objectHTTPOK(trans('lang.otp_matched'),$response);
    }
    //FOR FORGOT PASSWORD
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number'  => 'required',
            'otp'            => 'required',
            'password'       => 'required',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }
        
        $mobile_number     = $request->mobile_number;
        $otp               = $request->otp;
        $password          = $request->password;
        
        $data              = User::where(function ($q) use ($mobile_number, $otp) {
            $q->where('mobile_number', $mobile_number);
        }
        )->orWhere(function ($q) use ($mobile_number, $otp) {
            $q->where('mobile_number', $mobile_number);
            }
        )->first();
        
        if(empty($data)) {

            return $this->responseData->httpbadREQUEST(trans('lang.not_register_user'));
        }
        if($request->otp != $data->otp) {
        
            return $this->responseData->httpbadREQUEST(trans('lang.opt_not_match'));
        }
        
        $data->password     = bcrypt($request->password);
        $data->otp          = '';
        $data->save();

        $response  = (object) []; 
        return $this->responseData->objectHTTPOK(trans('lang.pass_reset_success'),$response);
    }
    /*
    --------------------------------------------------------------------
    | FOR LOGOUT
    --------------------------------------------------------------------
     */
    public function doLogout(Request $request)
    {

        $user                   = auth('api')->user();
        $userData               = User::find($user->id);
        $userData->device_token = "";
        $userData->device_type  = "";
        $userData->save();
        // Delete token
        $request->user()->token()->revoke();

        $response  = (object) []; 
        return $this->responseData->objectHTTPOK(trans('lang.logout_success'),$response);
    }
    
    public function loginNew(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile'       => 'required',
            'country_code' => 'required',
            'device_type'  => 'required',
            'device_token' => 'required',

        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $mobile = $request->mobile;
        $country_code = $request->country_code;
        $data = User::where(function ($q) use ($mobile, $country_code) {
            $q->where('mobileNo', $mobile)->where('country_code', $country_code);
        }
        )
            ->first();

        if (empty($data)) {
            $output["message"] = trans('lang.not_register_user');
            $output["status"] = 400;
            return response()->json($output, 200);
        }

        //  if(!$data->email_verified_at)
        // {
        //     $output["message"] = trans('lang.verify_email');
        //     $output["status"]  = 400;
        //     return response()->json($output ,200);
        // }

        if ($data->status == 0) {
            $output["message"] =  trans('lang.delete_user');
            $output["status"] = 400;
            return response()->json($output, 200);
        }

        if ($data->isActive == 0) {
            $output["message"] = trans('lang.deactivate');
            $output["status"] = 400;
            return response()->json($output, 200);
        }

//        if(!$data->email_verified_at)
        //        {
        //            $output["message"] = "verify your email id";
        //            $output["status"]  = 400;
        //            return response()->json($output ,200);
        //        }

//        $checkPwd = Hash::check($request->password,$data->password);
        //
        //        if ($checkPwd != 1)
        //        {
        //            $output["message"] = "invalid Email id and pasword";
        //            $output["status"] = 400;
        //            return response()->json($output ,200);
        //        }

        $data->device_type = $request->device_type;
        $data->device_token = $request->device_token;
        $data->save();
        $data->token = $token = $data->createToken('MyApp')->accessToken;

        if (!empty($data->image)) {
            $profileImg = $data->image;
        } else {
            $profileImg = "user.png";
        }

        $msgData = array();
        $message = "You have login Successfully.";

        //$this->PushService->sendPushNotification('1',$message,$msgData);
        $userdata = User::with(['active_plan' => function ($query) use ($request) {
            $query->where('is_active_plan', 1);
        }])->where('id', $data->id)->where('status', 1)->first();
        $userdata->token = $token;
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.login_success'),
            'data' => $userdata,

        ]);

    }
    public function loginv2(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'country_code' => 'required',
            'device_type' => 'required',
            'device_token' => 'required',

        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $mobile = $request->mobile;
        $country_code = $request->country_code;
        $data = User::where(function ($q) use ($mobile, $country_code) {
            $q->where('mobileNo', $mobile)->where('country_code', $country_code);
        }
        )
            ->first();

        if (empty($data)) {
            $output["message"] = trans('lang.not_register_user');
            $output["status"] = 400;
            return response()->json($output, 200);
        }

        //  if(!$data->email_verified_at)
        // {
        //     $output["message"] = trans('lang.verify_email');
        //     $output["status"]  = 400;
        //     return response()->json($output ,200);
        // }

        if ($data->status == 0) {
            $output["message"] =  trans('lang.delete_user');
            $output["status"] = 400;
            return response()->json($output, 200);
        }

        if ($data->isActive == 0) {
            $output["message"] = trans('lang.deactivate');
            $output["status"] = 400;
            return response()->json($output, 200);
        }

//        if(!$data->email_verified_at)
        //        {
        //            $output["message"] = "verify your email id";
        //            $output["status"]  = 400;
        //            return response()->json($output ,200);
        //        }

//        $checkPwd = Hash::check($request->password,$data->password);
        //
        //        if ($checkPwd != 1)
        //        {
        //            $output["message"] = "invalid Email id and pasword";
        //            $output["status"] = 400;
        //            return response()->json($output ,200);
        //        }

        $data->device_type = $request->device_type;
        $data->device_token = $request->device_token;
        $data->save();
        $data->token = $token = $data->createToken('MyApp')->accessToken;

        if (!empty($data->image)) {
            $profileImg = $data->image;
        } else {
            $profileImg = "user.png";
        }

        $msgData = array();
        $message = "You have login Successfully.";

        //$this->PushService->sendPushNotification('1',$message,$msgData);
        $userdata = User::with(['active_plan' => function ($query) use ($request) {
            $query->where('is_active_plan', 1);
        }])->where('id', $data->id)->where('status', 1)->first();
        $userdata->token = $token;
        $userdata->server_current_time = Carbon::now();
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.login_success'),
            'data' => $userdata,

        ]);

    }
    public function loginv3(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'country_code' => 'required',
            'device_type' => 'required',
            'device_token' => 'required',

        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $mobile = $request->mobile;
        $country_code = $request->country_code;
        $data = User::where(function ($q) use ($mobile, $country_code) {
            $q->where('mobileNo', $mobile)->where('country_code', $country_code);
        }
        )->first();

        if (empty($data)) {
            $output["message"] = trans('lang.not_register_user');
            $output["status"] = 400;
            return response()->json($output, 200);
        }
        if ($data->status == 0) {
            $output["message"] =  trans('lang.delete_user');
            $output["status"] = 400;
            return response()->json($output, 200);
        }

        if ($data->isActive == 0) {
            $output["message"] = trans('lang.deactivate');
            $output["status"] = 400;
            return response()->json($output, 200);
        }

        $data->device_type = $request->device_type;
        $data->device_token = $request->device_token;
        $data->save();
        $data->token = $token = $data->createToken('MyApp')->accessToken;

        if (!empty($data->image)) {
            $profileImg = $data->image;
        } else {
            $profileImg = "user.png";
        }

        $msgData = array();
        $message = "You have login Successfully.";

        //$this->PushService->sendPushNotification('1',$message,$msgData);
        $userdata = User::with(['active_plan' => function ($query) use ($request) {
            $query->where('is_active_plan', 1);
        }])->where('id', $data->id)->where('status', 1)->first();
        $Subscriptionsdata = Subscriptions::first();
        $userdata->isFreeTrialAvailable = $Subscriptionsdata->isFreeTrialAvailable;
        $userdata->token = $token;
        $userdata->server_current_time = Carbon::now();
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.login_success'),
            'data' => $userdata,

        ]);

    }
    

}
