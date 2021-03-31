<?php

namespace App\Http\Controllers\Api;

use App;
use App\Http\Controllers\Controller;
use App\Models\MessageGroup;
use App\Models\MessageReadLog;
use App\Models\Messages;
use App\Models\User;
use DB;
use App\Services\PushService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class MessageController extends Controller
{
    //
    public function __construct()
    {
         $this->PushService    = new PushService();
    }
    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'receiverId' => 'required',
            'message' => 'required',
            // 'name' => 'required',

        ]);
        $user = Auth::user();
        $user_id = $user->id;

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }

        $receiverInfo = User::where('id', $request->receiverId)->where('status', 1)->first();
        DB::enableQueryLog();

        $chatGroupInfo = MessageGroup::whereRaw("( senderId = $request->receiverId AND receiver_id = $user_id) OR ( senderId = $user_id AND receiver_id = $request->receiverId)")->get();
        // print_r($chatGroupInfo);
        if (count($chatGroupInfo) != 0) {
            // old group

            $addmessageData = array(
                "messageGroupId" => $chatGroupInfo[0]->id,
                "senderId" => $user_id,
                "receiverId" => $request->receiverId,
                "message" => $request->message);
            $messageData = Messages::create($addmessageData);
            if ($messageData) {
                $data = Messages::where('id', $messageData->id)->where('status', 1)->first();
                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => "",
                    'data' => array("rows" => $data),

                ]);
            } else {
                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => trans('lang.please_try_again'),
                    'data' => array("rows" => array()),

                ]);
            }

        } else {
            // new grouop
            $addGroupdata = array("senderId" => $user_id,
                "receiver_id" => $request->receiverId);

            $GroupInfo = MessageGroup::create($addGroupdata);
            $groupId = $GroupInfo->id;
            $addmessageData = array(
                "messageGroupId" => $groupId,
                "senderId" => $user_id,
                "receiverId" => $request->receiverId,
                "message" => $request->message);
            $messageData = Messages::create($addmessageData);
            if ($messageData) {
                $data = Messages::where('id', $messageData->id)->where('status', 1)->first();
                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => "",
                    'data' => array("rows" => $data),

                ]);
            } else {
                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => trans('lang.please_try_again'),
                    'data' => array("rows" => array()),

                ]);
            }
        }
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.please_try_again'),
            'data' => array("rows" => $chatGroupInfo),

        ]);

    }

    
    public function UserChatlists(Request $request)
    { 
        $user = Auth::user();
        $user_id = $user->id;
        $UserChatlist = MessageGroup::with("last_messsage", "sender_info", "receiver_info")->whereRaw("(receiver_id = $user_id) OR ( senderId = $user_id )")->get();
        if ($UserChatlist) {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => array("rows" => $UserChatlist),

            ]);
        } else {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows" => array()),

            ]);
        }
    }
    public function messageList(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'receiverId' => 'required',
        ]);
        $user = Auth::user();
        $user_id = $user->id;

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $messageList = Messages::whereRaw("( senderId = $request->receiverId AND receiverId = $user_id) OR ( senderId = $user_id AND receiverId = $request->receiverId)")->get();

        if ($messageList) {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => array("rows" => $messageList),

            ]);
        } else {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows" => array()),

            ]);
        }
    }
    public function newMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiverId' => 'required',
        ]);
        $user = Auth::user();
        $user_id = $user->id;

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $messageList = Messages::select("messages.*", DB::Raw('IFNULL(`message_read_log`.`isRead` , 0 ) as isRead'))
            ->with('sender_info', 'receiver_info')
            ->leftJoin("message_read_log", function ($query) use ($user_id) {
                $query->on('message_read_log.messageId', '=', 'messages.id')->where('message_read_log.userId', '=', $user_id);
            })->whereRaw("( messages.senderId = $request->receiverId AND messages.receiverId = $user_id) OR ( messages.senderId = $user_id AND messages.receiverId = $request->receiverId)")->whereNull('message_read_log.id')->orderBy('messages.id', 'DESC')->get();
        foreach ($messageList as $m) {
            if ($m->isRead == 0) {
                $messagedata = array("messageId" => $m->id,
                    "userId" => $user_id,
                    "isRead" => 1,
                    "status" => 1);
                MessageReadLog::create($messagedata);
            }
        }

        if ($messageList) {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => array("rows" => $messageList),

            ]);
        } else {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows" => array()),

            ]);
        }

    }
    public function save_chat_message(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'receiverId' => 'required',
            // 'type' => 'required',
            // 'messageGroupId' => 'required',
            //'name' => 'required',

        ]);
        $user = Auth::user();
        $user_id = $user->id;

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $type = "message";
        if ($request->url != "") {
            $type = "file";
        }
        $chatGroupInfo = MessageGroup::whereRaw("( senderId = $request->receiverId AND receiver_id = $user_id) OR ( senderId = $user_id AND receiver_id = $request->receiverId)")->get();
        // print_r($chatGroupInfo);
        if (count($chatGroupInfo) != 0) {
            $addmessageData = array(
                "messageGroupId" => $chatGroupInfo[0]->id,
                "senderId" => $user_id,
                "type" => $type,
                "url" => $request->url,
                "receiverId" => $request->receiverId,
                "message" => $request->message);
            $messageData = Messages::create($addmessageData);
            if ($messageData) {
                $data = Messages::where('id', $messageData->id)->where('status', 1)->first();
                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => "",
                    'data' => array("rows" => $data),

                ]);
            } else {
                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => trans('lang.please_try_again'),
                    'data' => array("rows" => array()),

                ]);
            }
        } else {
            $addGroupdata = array("senderId" => $user_id,
                "receiver_id" => $request->receiverId);

            $GroupInfo = MessageGroup::create($addGroupdata);
            $groupId = $GroupInfo->id;
            $addmessageData = array(
                "messageGroupId" => $groupId,
                "senderId" => $user_id,
                "type" => $type,
                "url" => $request->url,
                "receiverId" => $request->receiverId,
                "message" => $request->message);
            $messageData = Messages::create($addmessageData);
            if ($messageData) {
                $data = Messages::where('id', $messageData->id)->where('status', 1)->first();
                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => "",
                    'data' => array("rows" => $data),

                ]);
            } else {
                return response()->json([
                    'status' => Controller::HTTP_OK,
                    'message' => trans('lang.please_try_again'),
                    'data' => array("rows" => array()),
                ]);
            }
        }

    }
    public function addPhotos(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'media_file' => 'required',

        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $user = Auth::user();

        $uplodephotos = array();

        if (!empty($request->file('media_file'))) {

            foreach ($request->file('media_file') as $image) {
                $imgName = time() . '-' . $image->getClientOriginalName();
                $destinationPath = public_path('/uploads/messagePhotos/');
                $image->move($destinationPath, $imgName);
                
                $img = url('/public/uploads/messagePhotos').'/'.$imgName;
                array_push($uplodephotos, $img);
            }
        }
        if ($uplodephotos > 0) {

            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => 'Yacht Photo upload successfully',
                'data' => array("rows"=>$uplodephotos),
            ]);
        } else {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => 'Please try again after some time',
                'data' => array("rows"=> array()),
            ]);
        }

    }
    public function sendNotification(Request $request){
        $validator = Validator::make($request->all(), [

            'receiverId' => 'required',
            // 'type' => 'required',
            // 'messageGroupId' => 'required',
            //'name' => 'required',

        ]);
        $user = Auth::user();
        $user_id = $user->id;

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $type = "message";
        if ($request->url != "") {
            $type = "file";
        }
        $chatGroupInfo = MessageGroup::whereRaw("( senderId = $request->receiverId AND receiver_id = $user_id) OR ( senderId = $user_id AND receiver_id = $request->receiverId)")->get();
        // print_r($chatGroupInfo);
        if (count($chatGroupInfo) != 0) {
            $addmessageData = array(
                "messageGroupId" => $chatGroupInfo[0]->id,
                "senderId" => $user_id,
                "type" => $type,
                "url" => $request->url,
                "receiverId" => $request->receiverId,
                "message" => $request->message);
            $messageData = Messages::create($addmessageData);
            if ($messageData) {
                $data = Messages::where('id', $messageData->id)->where('status', 1)->first();
                $msgData                  = array();
        $message                  = "You have login Successfully.";  
        
        $this->PushService->sendPushNotification($user_id,$message,$msgData);
                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => "",
                    'data' => array("rows" => $data),

                ]);
            } else {
                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => trans('lang.please_try_again'),
                    'data' => array("rows" => array()),

                ]);
            }
        } else {
            $addGroupdata = array("senderId" => $user_id,
                "receiver_id" => $request->receiverId);

            $GroupInfo = MessageGroup::create($addGroupdata);
            $groupId = $GroupInfo->id;
            $addmessageData = array(
                "messageGroupId" => $groupId,
                "senderId" => $user_id,
                "type" => $type,
                "url" => $request->url,
                "receiverId" => $request->receiverId,
                "message" => $request->message);
            $messageData = Messages::create($addmessageData);
            if ($messageData) {
                $data = Messages::where('id', $messageData->id)->where('status', 1)->first();
                $msgData                  = array();
                $message                  = "You have login Successfully.";  
                
                $this->PushService->sendPushNotification($user_id,$message,$messageData);
                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => "",
                    'data' => array("rows" => $data),

                ]);
            } else {
                return response()->json([
                    'status' => Controller::HTTP_OK,
                    'message' => trans('lang.please_try_again'),
                    'data' => array("rows" => array()),
                ]);
            }
        }
    }
    public function testsendNotification(Request $request){
        // $messageData                  = array();
        //         $message                  = "You have login Successfully.";  
        // $this->PushService->sendPushNotification(71,$message,$messageData);
        
    }

}
