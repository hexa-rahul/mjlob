<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\VerfiyMail;
use App\Models\CountriesList;
use App\Models\Country;
use App\Models\User;
use App\Models\YachtCategory;
use App\Models\MasterCategory;
use App\Models\Subscriptions;
use App\Services\ExistingClass;
use App\Services\responseData;
use Illuminate\Http\Request;
use Mail;
use Validator;

class RegisterController extends Controller
{

    public function __construct($foo = null)
    {
        $this->driver = new ExistingClass();
        $this->responseData = new responseData();
    }

    /*
    --------------------------------------------------------------------
    | USER REGISTRATION
    --------------------------------------------------------------------
     */
    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'username'       => 'required',
            'mobile_number'  => 'required',
            'password'       => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }
        
        $username          = $request->username;
        $mobile_number     = $request->mobile_number;
        $otp               = substr(str_shuffle("0123456789"), 0, 4);

        if($this->driver->isNumberisUniqe($mobile_number) == true){
            return $this->responseData->ISEXIST(trans('lang.mobile_already_exist'));
        }
        if($this->driver->isUsernameisUniqe($username) == true){
            return $this->responseData->ISEXIST(trans('lang.username_already_exist'));
        }

        $input             = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['otp']      = $otp;
        $response          = User::create($input);
        $response['token'] = $response->createToken('MyApp')->accessToken;
        
        return $this->responseData->objectHTTPOK(trans('lang.registration_msg'),$response);
    }

    public function verificationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'verificationCode' => 'required',
            'mobileNo' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $User = User::where('mobileNo', $request->mobileNo)->where('otp', $request->verificationCode)->get();
        if (count($User) > 0) {
            $result = User::where('id', $User[0]->id)
                ->update([
                    'email_verified_at' => date('Y-m-d H:i:s'),
                ]);
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.registration_msg'),
                'object' => $User,

            ]);
        } else {
            $output["message"] = trans('lang.OTP_code_not_verified');
            $output["status"] = 400;
            return response()->json($output, 200);
        }

    }
    public function resendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobileNo' => 'required',
        ]);
        $otp = substr(str_shuffle("0123456789"), 0, 4);
        $input['otp'] = $otp;
        $otp_array = array("otp" => $input['otp']);
        $result = User::where('mobileNo', $request->mobileNo)
            ->update([
                'otp' => $otp,
            ]);
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.OTP_sent_successfully'),
            'data' => (object) $otp_array,

        ]);
    }
   
    public function countryList(Request $request)
    {
        $statusDropdown = Country::where("status", 1)->orderBy('position', 'ASC')->get();
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' =>  trans('lang.User_countries_data'),
            'data' => array("country"=>$statusDropdown),

        ]);
    }
   

    public function categoryList(Request $request)
    {
        $category     = MasterCategory::orderBy('id', 'desc')->where("is_deleted",0 )->get();
        
        return response()->json([

            'status'  => Controller::HTTP_OK,
            'message' => "Master Category List",
            'data'    => array("Category"=>$category),

        ]);
    }
}
