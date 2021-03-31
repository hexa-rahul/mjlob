<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\File;
use App\Services\responseData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PushService;
use Validator;
use DB;

class NotificationController extends Controller
{
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
    //FOR ABOUT US
    public function getNotifications(Request $request)
    {
        $user        = Auth::user();
        $user_id     = $user->id;

        $response    = Notification::where('reciver_id', $user_id)->where('deleted_at', null)->with('userDetail')->paginate();
        if($response->count()>0){
            return $this->responseData->arrayHTTPOK(trans('lang.noti_list'),$response);
        }else{
            return $this->responseData->httpbadREQUEST(trans('lang.data_not_found'));
        }    
    }
    //FOR DELETE
    public function deleteAll(Request $request){

        $user        = Auth::user();
        $user_id     = $user->id;

        Notification::where('reciver_id', $user_id)->update(['deleted_at' => Carbon::now() ]);
        $response = (object) [];
        return $this->responseData->objectHTTPOK(trans('lang.delete_success'),$response);
    }
}