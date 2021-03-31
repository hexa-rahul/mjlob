<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ContactUs;
use Carbon\Carbon;
use Illuminate\Http\File;
use App\Services\responseData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PushService;
use Validator;
use DB;

class ContactusController extends Controller
{
    //
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->responseData = new responseData();
        $this->PushService  = new PushService();
    }
    
    public function contactUs(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'mobile_number' => 'required',
            'message'       => 'required', 
        ]);
        if($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }

        $user          = Auth::user();
        $user_id       = $user->id;
        $message       = $request->message;
        $mobile_number = $request->mobile_number;
        
        $response      = ContactUs::create(['user_id' => $user_id, 'mobile_number' => $mobile_number, 'message' => $message ]);
        
        return $this->responseData->arrayHTTPOK(trans('lang.msg_send_success'),$response);
    }
}