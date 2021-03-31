<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PushService;
use Validator;
use Session;
use Redirect;


use  Illuminate\Http\RedirectResponse;



class NotificationController extends Controller
{
    //
    public function __construct()
    {
        $this->PushService = new PushService();
      //  $this->middleware('guest')->except('addPhotos');
    }
    public function index(Request $request)
    {

        $userdata = User::where("deleted_at",null)->get();
        $title = trans('lang.notification');
        return view('admin/notification')->with(compact(['userdata', 'title']));

    }
    public function sendNotification(Request $request){ 
       
        $message_info = array("type" => "NEW_MESSAGE",
                    "title" => "New Message",
                    "notifiaction_type" => "chat",
                    "message" => $request->message,
                    "fromId" => "",
                    "toId" => "",
                    "messageGroupId" => "",
                    "url" => "",
                    "type" => "message",
                    "firstName" => "",
                    "lastName" => "",
                    "profilePictureThumbUrl" => "",
                    "badge" => 0,
                );
        $message = $request->message;
        if($request->notification_to == "alluser"){
            $userdata = User::where("status",1)->where("user_type","User")->get();
            foreach($userdata as $user){
                $this->PushService->sendPushNotification($user->id, $message, $message_info);
            }
            // echo "user ";
        }else 
        // if($request->notification_to == "all_services_provider"){
        //     $userdata = User::where("status",1)->where("user_type","Owner")->get();
        //     foreach($userdata as $user){
        //         $this->PushService->sendPushNotification($user->id, $message, $message_info);
        //     }
        // }else
        {
            // echo "provider  user id";
            $this->PushService->sendPushNotification($request->notification_to, $message, $message_info);
        }
        // return redirect('admin/notification')->with('message', '');
        Session::put('flash_message', 'Notification Send successfully!'); 
        Session::save();
        return redirect()->back();

        // return redirect()->route('admin.notification');
       
        
    }

}
