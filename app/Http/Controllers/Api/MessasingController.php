<?php

namespace App\Http\Controllers\Api;

use App;
use App\Http\Controllers\Controller;
use App\Models\MessageGroup;
use App\Models\MessageReadLog;
use App\Models\Messages;
use App\Models\User;
use App\Services\PushService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class MessasingController extends Controller
{
    //
    public function __construct()
    {
        $this->PushService = new PushService();
      //  $this->middleware('guest')->except('addPhotos');
    }
    public function sendMessage(Request $request)
    {
       
       return $request->all();
        $validator = Validator::make($request->all(), [

            'receiverId' => 'required',
            'message'    => 'required',
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

        $receiverInfo = User::where('id', $request->receiverId)->first();
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
        $user    = Auth::user();
        $user_id = $user->id;
        // $UserChatlist = MessageGroup::with("last_messsage", "sender_info", "receiver_info")->whereRaw("(receiver_id = $user_id) OR ( senderId = $user_id )")->get();

        $UserChatlistold = MessageGroup::with("last_messsage", "sender_info", "receiver_info")->whereRaw("(receiver_id = $user_id) OR ( senderId = $user_id )")->get()->sortBy('last_messsage.created_at',SORT_DESC,false);
        $UserChatlist = array();

        foreach($UserChatlistold as $u){
            array_push($UserChatlist, $u);

        }
       // print_R($UserChatlist[0]->last_messsage->created_at);
        // die();
        if ($UserChatlist) {
            foreach($UserChatlist as $u){
                $receiverId = $u["receiver_id"];
                $senderId = $u["senderId"];
                $messagecout = 0;
              $countarray =   Messages::select("messages.*", DB::Raw('IFNULL("message_read_log.isRead" , 0 ) as isRead'))
            ->leftJoin("message_read_log", function ($query) use ($user_id) {
                $query->on('message_read_log.messageId', '=', 'messages.id')->where('message_read_log.userId', '=', $user_id);
            })->whereRaw("( ( 'messages.senderId' = $receiverId AND 'messages.receiverId' = $senderId) OR ( 'messages.senderId' = $senderId AND 'messages.receiverId' = $receiverId) )")->whereNull('message_read_log.id')->orderBy('messages.id', 'DESC')->get();
        //    echo $countarray;
            $u['newMessagecout'] = count($countarray);
            // foreach($countarray as $m){
            //     if($m['isRead'] == 0){
            //         $messagecout++;   
            //     }
            // }
            // $u['newMessagecout'] = $messagecout;
            // $u['lastmessage_date'] = $u->last_messsage->created_at;
            $u['lastmessage_date'] = '';
                
            
        }
        $columns = array_column($UserChatlist, 'lastmessage_date');
        array_multisort($columns, SORT_DESC, $UserChatlist);
            
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
        $receiverId = $request->receiverId;
        $senderId = $user_id;
        $messageList = Messages::whereRaw("( senderId = $request->receiverId AND receiverId = $user_id) OR ( senderId = $user_id AND receiverId = $request->receiverId)")
        ->orderBy('id', 'DESC')->get();
        $newmessageList = Messages::select("messages.*", DB::Raw('IFNULL("message_read_log.isRead" , 0 ) as isRead'))
            ->leftJoin("message_read_log", function ($query) use ($user_id) {
                $query->on('message_read_log.messageId', '=', 'messages.id')->where('message_read_log.userId', '=', $user_id);
            })->whereRaw("( 'messages.senderId' = $receiverId AND 'messages.receiverId' = $senderId) OR ( 'messages.senderId' = $senderId AND 'messages.receiverId' = $receiverId)")->whereNull('message_read_log.id')->orderBy('messages.id', 'DESC')->get();
        foreach ($newmessageList as $m) {
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
    public function newMessageCount(Request $request)
    {
        
        $user = Auth::user();
        $user_id = $user->id;

        
        $countarray  =  Messages::select("messages.*", DB::Raw('IFNULL(`message_read_log`.`isRead` , 0 ) as isRead'))
            ->leftJoin("message_read_log", function ($query) use ($user_id) {
                $query->on('message_read_log.messageId', '=', 'messages.id')->where('message_read_log.userId', '=', $user_id);
            })->whereRaw("((messages.receiverId = $user_id) OR ( messages.senderId = $user_id ))")->whereNull('message_read_log.id')->orderBy('messages.id', 'DESC')->get();
            // $messagecout = 0;
            // foreach($countarray as $m){
            //     if($m['isRead'] == 0){
            //         $messagecout++;   
            //     }
            // }
            $newm['newMessagecout'] = count($countarray);
        if ($newm) {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => array("rows" => $newm),

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
                "unique_id" => $request->unique_id,
                "api_name" => "savemessage",
                "receiverId" => $request->receiverId,
                "message" => $request->message);
            $messageData = Messages::create($addmessageData);
            $addmessagelog = array("messageId" => $messageData->id,
                    "userId" => $user_id,
                    "isRead" => 1,
                    "status" => 1);
                MessageReadLog::create($addmessagelog);
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
                "unique_id" => $request->unique_id,
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

                $img = url('/public/uploads/messagePhotos') . '/' . $imgName;
                array_push($uplodephotos, $img);
            }
        }
        if ($uplodephotos > 0) {

            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.yacht_photo_upload_successfully'),
                'data' => array("rows" => $uplodephotos),
            ]);
        } else {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.try_again'),
                'data' => array("rows" => array()),
            ]);
        }

    }
    public function sendNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'receiverId' => 'required',
            // 'type' => 'required',
            // 'messageGroupId' => 'required',
            //'name' => 'required',

        ]);
        $user = Auth::user();
        $user_id = $user->id;
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $image = $user->image;

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
                "unique_id" => $request->unique_id,
                "api_name" => "sendNotification",
                "receiverId" => $request->receiverId,
                "message" => $request->message);
            // $messageData = Messages::create($addmessageData);
            // if ($messageData) {
                if (count($chatGroupInfo) != 0) {
                // $data = Messages::where('id', $messageData->id)->where('status', 1)->first();
                $msgData = array();
                $message = "$firstName $lastName has sent new message.";
                $message_info = array("type" => "NEW_MESSAGE",
                    "title" => "New Message",
                    "notifiaction_type" => "chat",
                    "message" => $request->message,
                    "fromId" => $user_id,
                    "toId" => $request->receiverId,
                    "messageGroupId" => $chatGroupInfo[0]->id,
                    "url" => $request->url,
                    "type" => $type,
                    "firstName" => $firstName,
                    "lastName" => $lastName,
                    "profilePictureThumbUrl" => $image,
                    "badge" => 0,
                );
                //print_r($message_info);
                $this->PushService->sendPushNotification($request->receiverId, $message, $message_info);
                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => "",
                    'data' => array("rows" => $addmessageData),

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
                "unique_id" => $request->unique_id,
                "receiverId" => $request->receiverId,
                "message" => $request->message);
            // $messageData = Messages::create($addmessageData);
            // if ($messageData) {
            if ($GroupInfo) {
                $data = Messages::where('id', $messageData->id)->where('status', 1)->first();
                $msgData = array();
                $message = "You have login Successfully.";

                $message = "$firstName $lastName has sent new message.";
                $message_info = array("type" => "NEW_MESSAGE",
                    "title" => "New Message",
                    "notifiaction_type" => "chat",
                    "message" => $request->message,
                    "fromId" => $user_id,
                    "toId" => $request->receiverId,
                    "messageGroupId" => $chatGroupInfo[0]->id,
                    "url" => $request->url,
                    "type" => $type,
                    "firstName" => $firstName,
                    "lastName" => $lastName,
                    "profilePictureThumbUrl" => $image,
                    "badge" => 0,
                );
                //print_r($message_info);
                $this->PushService->sendPushNotification($request->receiverId, $message, $message_info);
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
    public function testsendNotification(Request $request)
    {
        $messageData                  = array();
                $message                  = "You have login Successfully.";
        $this->PushService->sendPushNotification(47, $message, $messageData);

    }

}
