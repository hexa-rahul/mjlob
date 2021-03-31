<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ExistingClass;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Services\responseData;
use Validator;

class ProfileController extends Controller
{
    public function __construct(Request $request)
    {
        $this->responseData = new responseData();
        $this->driver       = new ExistingClass();
        $local              = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : 'en';
        // set laravel localization
        app()->setLocale($local);
    }
    //
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    //FOR GET PROFILE DETAIL
    public function getDetail()
    {
        
        $user      = Auth::user();
        $userdata  = User::where('id', $user->id)->where('deleted_at', null)->first();
        
        if($user){
            
            return $this->responseData->objectHTTPOK(trans('lang.user_detail'),$userdata);
        } else {

            return $this->responseData->httpbadREQUEST(trans('lang.user_not_found'));
        }
    }
    //FOR UPDATE PROFILE DETAIL
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'  => 'required',
        ]);
        if ($validator->fails()) {
            
            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }

        $user      = Auth::user();
        $user_id   = $user->id;
        
        if (!empty($request->file('image'))) {

            $image           = $request->file('image');
            $imgName         = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/user-profile/');
            $image->move($destinationPath, $imgName);
            $user->image     = $imgName;
        }

        $google_map_link       = ($request->google_map_link)?$request->google_map_link:$user->google_map_link;  
        $user->full_name       = $request->full_name;
        $user->google_map_link = $google_map_link; 
        $user->save();

        if($user){

            return $this->responseData->objectHTTPOK(trans('lang.user_detail'),$user);
        } else {

            return $this->responseData->httpbadREQUEST(trans('lang.user_not_found'));
        }

    }
    //FOR CHANGE PASSWORD
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password'     => 'required',
        ]);
        if ($validator->fails()) {
            
            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }

        $user      = Auth::user();
        $user_id   = $user->id;
        
        $checkPwd = Hash::check($request->current_password, $user->password);
        if ($checkPwd != 1) {
        
            return $this->responseData->httpbadREQUEST(trans('lang.cur_pass_not_match'));
        }
        
        $user->password = bcrypt($request->new_password);
        $user->save();

        if($user){

            return $this->responseData->objectHTTPOK(trans('lang.pas_chang_succ'),$user);
        } else {

            return $this->responseData->httpbadREQUEST(trans('lang.pas_not_change'));
        }
    }
    //FOR UPDATE PROFILE IMAGE
    public function updateProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(),['image'=>'required']);

        if($validator->fails()){ $errors = $validator->errors()->toArray();
            
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }
        $user    = Auth::user();
        $user_id = $user->id;

        if (!empty($request->file('image'))) {

            $image           = $request->file('image');
            $imgName         = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/user-profile/');
            $image->move($destinationPath, $imgName);
            $imageName       = $imgName;
            User::where('id', $user_id)->where('deleted_at', null)->update(['image' => $imageName]);
            return $this->responseData->objectHTTPOK(trans('lang.update_profile'),$user);

        }else{
            
            return $this->responseData->httpbadREQUEST(trans('lang.please_try_again'));
        }

    }
    //FOR CHANGE LANGUAGE
    public function selectLanguage(Request $request)
    {
        $user     = Auth::user();
        $response =(object) [];
        return $this->responseData->objectHTTPOK(trans('lang.changed_language'),$response);
    }

}