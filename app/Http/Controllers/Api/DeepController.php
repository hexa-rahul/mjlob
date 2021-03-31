<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MasterCategory;
use App\Models\FavouriteCategory;
use Carbon\Carbon;
use Illuminate\Http\File;
use App\Services\responseData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PushService;
use Validator;
use DB;

class DeepController extends Controller
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
    
    public function redirectDeepLink(Request $request) {

        try {
            $device = $this->isMobileDevice();
            // $id = $request->input('itemId');
            $id = '2';
            $app = config('constant.DEEPLINKING.APP') . $id;



            $data = array();
            if ($device == 'iPhone') {

                $data['primaryRedirection'] = $app;
                $data['secndaryRedirection'] = config('constant.DEEPLINKING.APPSTORE');
            
            } else if ($device == 'Android') {

                $data['primaryRedirection']  = $app;
                $data['secndaryRedirection'] = config('constant.DEEPLINKING.APP');

            } else {
                
                $redirect = config('constant.DEEPLINKING.WEBSITE');
                $redirect = "http://hexalitics.com";
                $app_url = 'fb://profile/33138223345';
                return redirect($redirect);
            }
            return View('deep', $data);

        } catch (Exception $e) {
            
            Log::error(__METHOD__ . ' ' . $e->getMessage());
            return Utilities::responseError(__('messages.SOMETHING_WENT_WRONG') . $e->getMessage());
        }
    }

    private function isMobileDevice() {
        $aMobileUA = array(
            '/iphone/i'     => 'iPhone',
            '/ipod/i'       => 'iPod',
            '/ipad/i'       => 'iPad',
            '/android/i'    => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i'      => 'Mobile'
        );
        //Return true if Mobile User Agent is detected
        foreach ($aMobileUA as $sMobileKey => $sMobileOS) {
            if (preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])) {
                return $sMobileOS;
            }
        }
        //Otherwise return false..
        return false;
    }
    
   
}