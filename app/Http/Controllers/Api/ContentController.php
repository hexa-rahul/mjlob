<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\File;
use App\Services\responseData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PushService;
use Validator;
use DB;

class ContentController extends Controller
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
    public function aboutUs(Request $request)
    {
        $response    = SiteSetting::select('aboutUs')->where('id', 1)->first();
        return $this->responseData->objectHTTPOK(trans('lang.about_us'),$response);
    }
    //FOR TERMS AND CONDITIONS
    public function termsCondition(Request $request)
    {
        $response    = SiteSetting::select('trems')->where('id', 1)->first();
        return $this->responseData->objectHTTPOK(trans('lang.terms_condition'),$response);
    }
    //FOR PRIVACY POLICY
    public function privacyPolicy(Request $request)
    {
        $response    = SiteSetting::select('PrivacyPolicy')->where('id', 1)->first();
        return $this->responseData->objectHTTPOK(trans('lang.privacy_policy'),$response);
    }
}