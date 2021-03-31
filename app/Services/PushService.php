<?php

namespace App\Services;

use App\Models\User;
use Edujugon\PushNotification\PushNotification;

// use App\Models\Notification;

class PushService
{

    /*
    ---------------------------------------------------------------
    | FOR SEND PUSH NOTIFICATION
    ---------------------------------------------------------------
     */
    public function sendPushNotification($user_id = '', $message = '', $msgData = array(), $extra = array())
    {

        $getUser = User::where('id', $user_id)->where('deleted_at', null)->first();

        if (!empty($getUser)) {

            // $user_type   =   $getUser->user_type;
            $user_type = 1;
            $deviceType = $getUser->device_type;
            $deviceToken = $getUser->device_token;

            if (($deviceType == 'android') || ($deviceType == 'Android')) {

                $this->sendMessageAndroid($deviceToken, $message, $msgData, $user_type, $extra);

            } elseif (($deviceType == 'ios') || ($deviceType == 'iOS')) {

                $this->iosPushNotification($deviceToken, $message, $msgData, $user_type, $extra);
            }
        }

    }
    /*
    ---------------------------------------------------------------
    | FOR SEND iOS PUSH NOTIFICATION
    ---------------------------------------------------------------
     */
    public function iosPushNotification2($deviceToken = '', $message = '', $user_type = '', $extra = '')
    {

        if ($user_type == 1) {
            // FOR USER APP
            $push = new PushNotification('apu');
        }

        // if($user_type == 2){
        //     // FOR DRIVER APP
        //     $push = new PushNotification('apn');
        // }

        $data = [
            'aps' => [

                'alert' => [
                    'title' => 'Truck Yaah',
                    'body' => $message,
                    'noti_type' => 1,
                ],
                'sound' => 'default',
            ],
        ];

        $push->setMessage($data)->setDevicesToken([$deviceToken]);
        $push = $push->send();
        print_r($push);

        if ($push) {return $push;} else {return $push->getFeedback();}

    }
    /*
    ---------------------------------------------------------------
    | FOR SEND ANDROID PUSH NOTIFICATION
    ---------------------------------------------------------------
     */
    public function sendMessageAndroid($deviceToken, $message, $msgData = array(), $user_type = '', $extra = '')
    {

        if ($user_type == 1) {
            // FOR USER APP
            $user_firebase_api_key = "AAAA4ATHu4g:APA91bG_A5m9Ct4zORi2tMffSokF-a0ktQNqoEJ87S-iVtGm-6PaSAHXJdLeW7F9nYuO7_LvOYRvmxvcx4Fjh5vh6k_nM95UJDWIhyvFcX7fMidVUEfVS-3GkbgfzfrA2mT1Hq9fTv8N";
        }

        // if($user_type == 2){
        //     // FOR DRIVER APP
        //     $user_firebase_api_key   = "AIzaSyAhdnlcy4Z2xnl1HMK0SYnMGWaDGh8C1Gc";
        // }

        $firebase_send_url = 'https://fcm.googleapis.com/fcm/send';

        // API access key from Google API's Console
        if (!defined('API_ACCESS_KEY')) define('API_ACCESS_KEY', $user_firebase_api_key);
        $registrationIds = array($deviceToken);
        // prep the bundle
        $msg = array
            (
            'message'        => $message,
            'message' => $msgData,
            'title' => $message,
            'message'    => $msgData['message'],
            // 'vibrate' => 1,
            // 'sound' => 1,
        );
        $msgData['title'] = $message;
        $data = [
         
            // 'title' => $message,
            'message' =>   $msgData,
            
    ];
        // 
         
        //  $newmess = json_encode($msg ,JSON_FORCE_OBJECT);

        $fields = array
            (
            'registration_ids' => $registrationIds,
            'data' => $data,
        );
        //  print_r($msgData);

        $headers = array
            (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $firebase_send_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        // $this->insertserviceData($msgData);
        //  echo $result;
        // die();
        return $result;
    }
    public function iosPushNotification($deviceToken, $message, $msgData = array(), $user_type = '', $extra = '')
    {

        // if ($user_type == 1) {
        // FOR USER APP
        $user_firebase_api_key = "AAAA4ATHu4g:APA91bG_A5m9Ct4zORi2tMffSokF-a0ktQNqoEJ87S-iVtGm-6PaSAHXJdLeW7F9nYuO7_LvOYRvmxvcx4Fjh5vh6k_nM95UJDWIhyvFcX7fMidVUEfVS-3GkbgfzfrA2mT1Hq9fTv8N";
        // }

        // if($user_type == 2){
        //     // FOR DRIVER APP
        //     $user_firebase_api_key   = "AIzaSyAhdnlcy4Z2xnl1HMK0SYnMGWaDGh8C1Gc";
        // }

        $firebase_send_url = 'https://fcm.googleapis.com/fcm/send';

        // API access key from Google API's Console
        if (!defined('API_ACCESS_KEY')) define('API_ACCESS_KEY', $user_firebase_api_key);
        $registrationIds = array($deviceToken);
        // prep the bundle
        // print_r($msgData);
        $data = [
         
                'type' => $msgData["type"],
                'title'=> "New Message",
                'message' =>   $message,
                'fromId'=> $msgData["fromId"],
                'toId'=> $msgData["toId"],
                'url' =>$msgData["url"],
                'firstName' =>$msgData["firstName"],
                'lastName' =>$msgData["lastName"],
                'profilePictureThumbUrl' =>$msgData["profilePictureThumbUrl"],
                'badge' =>0
        ];
        // $notification = $data;
        // $fcmNotification = [
        //     //'registration_ids' => $tokenList, //multple token array
        //     'to'        => $registrationIds[0], //single token
        //     'data' => $data
        // ];
        // $title = "Title";
        // $body = "Body of the message";
        $notification = array('title' => $msgData["firstName"].' '.$msgData["lastName"], 'body' =>  $msgData["message"], 'sound' => 'default', 'badge' => '1','message'=>$data);
        $arrayToSend = array('to' => $registrationIds[0], 'notification' => $notification, 'priority' => 'high');
            echo json_encode($arrayToSend);
        $headers = array
            (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $firebase_send_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayToSend));
        $result = curl_exec($ch);
        curl_close($ch);
        //$this->insertserviceData($msgData);
        echo $result;
        // die();
        return $result;

    }

    //FOR SAVE NOTIFICATIONS
    // public function insertserviceData($msgData=array()){

    //     Notification::Create($msgData);
    //     return true;
    // }
}
