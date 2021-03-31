<?php

namespace App\Http\Controllers\Api;

use App;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\MessageList;
use App\Models\MessageReadLog;
use App\Models\User;
use App\Models\UserGroup;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class MessageControllerOld extends Controller
{
    //
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
        $receiver_id = $request->receiverId;
        $currentGroup1 = $receiver_id . ',' . $user_id;
        $currentGroup2 = $user_id . ',' . $receiver_id;
        $chatGroupInfo = Group::select('groups.id', DB::raw('GROUP_CONCAT(user_groups.`userId`) userIds'))
            ->Join("user_groups", function ($query) use ($user_id) {
                $query->on('user_groups.groupId', '=', 'groups.id');
            })->where('user_groups.userId', $user_id)
            ->orWhere('user_groups.userId', $request->receiverId)
            ->groupBy('groups.id')->get();

        $found = false;
        $groupId = "";
        foreach ($chatGroupInfo as $ginfo) {
            if ($ginfo->userIds == $currentGroup1 or $ginfo->userIds == $currentGroup2) {
                $found = true;
                $groupId = $ginfo->id;
            }
        }

        if ($found == true) {
            $addmessageData = array(
                "groupId" => $groupId,
                "senderId" => $user_id,
                "receiverId" => $receiver_id,
                "message" => $request->message);
            $messageData = MessageList::create($addmessageData);
            if ($messageData) {
                $data = MessageList::where('id', $messageData->id)->where('status', 1)->first();
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
            // die();
            if ($request->name == "") {
                $group_name = $user->firstName . ' ' . $user->lastName . ',' . $receiverInfo->firstName . ' ' . $receiverInfo->lastName;
            } else {
                $group_name = $request->name;
            }
            $addGroupdata = array(
                "names" => $group_name,
            );
            $GroupInfo = Group::create($addGroupdata);
            if ($GroupInfo) {
                $groupId = $GroupInfo->id;
                $addsenderdata = array(
                    "userId" => $user_id,
                    "groupId" => $groupId,
                );
                $addreceiverdata = array(
                    "userId" => $receiver_id,
                    "groupId" => $groupId,
                );
                UserGroup::create($addsenderdata);
                UserGroup::create($addreceiverdata);
                $addmessageData = array(
                    "groupId" => $groupId,
                    "senderId" => $user_id,
                    "receiverId" => $receiver_id,
                    "message" => $request->message);
                $messageData = MessageList::create($addmessageData);
                if ($messageData) {
                    $data = MessageList::where('id', $messageData->id)->where('status', 1)->first();
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

                return response()->json([

                    'status' => Controller::HTTP_OK,
                    'message' => trans('lang.please_try_again'),
                    'data' => array("rows" => array()),

                ]);
            }
        }

    }
    public function UserChatlist(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $Usergroupslist = Group::select('groups.id')->Join("user_groups", function ($query) use ($user_id) {
            $query->on('user_groups.groupId', '=', 'groups.id');
        })->where('user_groups.userId', $user_id)->get();
        $UserChatlist = UserGroup::select("user_groups.id", "user_groups.userId", "user_groups.groupId",'message_lists.id as mid', 'message_lists.message')
            ->with('user_data')
            ->Join('message_lists', function ($query) use($user_id) {
                $query->on('message_lists.groupId', '=', 'user_groups.id')
                    ->whereRaw("message_lists.id IN (select MAX(a2.id) from message_lists as a2 join user_groups as u2 on u2.id = a2.groupId where u2.userId != $user_id  group by u2.id)");
            })
        // ->leftJoin("message_lists", function ($query) use ($user_id) {
        //     $query->on('message_lists.groupId', '=', 'user_groups.id');
        // })
            ->where('user_groups.userId', '!=', $user_id)->get();
            // $query = UserGroup::select('user_groups.*', 'message_lists.message as article_comment')
            // ->leftJoin('message_lists', function($query) {
            //     $query->on('message_lists.groupId','=','user_groups.id')
            //         ->whereRaw('message_lists.id IN (select MAX(a2.id) from message_lists as a2 join user_groups as u2 on u2.id = a2.groupId group by u2.id)');
            // })->where('user_groups.userId', '!=', $user_id)->get();


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
            'groupId' => 'required',
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
        $receiver_id = $request->receiverId;
        $currentGroup1 = $receiver_id . ',' . $user_id;
        $currentGroup2 = $user_id . ',' . $receiver_id;
        $chatGroupInfo = Group::select('groups.id', DB::raw('GROUP_CONCAT(user_groups.`userId`) userIds'))
            ->Join("user_groups", function ($query) use ($user_id) {
                $query->on('user_groups.groupId', '=', 'groups.id');
            })->where('user_groups.userId', $user_id)
            ->orWhere('user_groups.userId', $request->receiverId)
            ->groupBy('groups.id')->get();

        $found = false;
        $groupId = "";
        foreach ($chatGroupInfo as $ginfo) {
            if ($ginfo->userIds == $currentGroup1 or $ginfo->userIds == $currentGroup2) {
                $found = true;
                $groupId = $ginfo->id;
            }
        }

        if ($found == true) {
            echo $groupId;
        }else{

        }
        $messageList = MessageList::select("message_lists.*", DB::Raw('IFNULL(`message_read_log`.`isRead` , 0 ) as isRead'))
            ->with('sender_info', 'receiver_info')
            ->leftJoin("message_read_log", function ($query) use ($user_id) {
                $query->on('message_read_log.messageId', '=', 'message_lists.id')->where('message_read_log.userId', '=', $user_id);
            })->where('groupId', $request->groupId)->orderBy('message_lists.id', 'DESC')->get();
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
        $messageList = MessageList::select("message_lists.*", DB::Raw('IFNULL(`message_read_log`.`isRead` , 0 ) as isRead'))
            ->with('sender_info', 'receiver_info')
            ->leftJoin("message_read_log", function ($query) use ($user_id) {
                $query->on('message_read_log.messageId', '=', 'message_lists.id')->where('message_read_log.userId', '=', $user_id);
            })->where('groupId', $request->groupId)->whereNull('message_read_log.id')->orderBy('message_lists.id', 'DESC')->get();
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

}
