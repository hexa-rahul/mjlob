<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MasterCategory;
use App\Models\AppSetting;
use Carbon\Carbon;
use Illuminate\Http\File;
use App\Services\responseData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PushService;
use Validator;
use DB;

class SettingController extends Controller
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
    
    public function update(Request $request)
    {
        $response    = AppSetting::where('id', 1)->first();
        $user_id     = ($request->user_id)?$request->user_id:'';
        if(!empty($user_id)){

            $response['notification_count']   =99;
            $response['unread_message_count'] =99;
        }else{

            $response['notification_count']   =0;
            $response['unread_message_count'] =0;
        }
        return $this->responseData->arrayHTTPOK(trans('lang.app_setting_data'),$response);
    }
}    