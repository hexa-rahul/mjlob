<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ExistingClass;
use Auth;
use Illuminate\Http\Request;
use Validator;

class UsersController extends Controller
{
    public function __construct($foo = null)
    {
        $this->driver = new ExistingClass();
    }
    //
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetail()
    {
        $user = Auth::user();
        $userdata = User::with(['active_plan' => function ($query) use ($user) {
            $query->where('is_active_plan', 1);
        }])->where('id', $user->id)->where('status', 1)->first();
        if ($user) {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' =>  trans('lang.user_details'),
                'object' => $userdata,
            ]);
        } else {

            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' =>  trans('lang.user_error'),
                'object' => (object) [],
            ]);
        }
    }
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'firstName' => 'required',
            'lastName' => 'required',
            // 'mobileNo' => 'required',

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
        $user_id = $user->id;
        // if ($this->driver->profileUpdateMobileNumber($user_id, $request->mobileNo) == true) {

        //     return response()->json([
        //         'status' => Controller::HTTP_BAD_REQUEST,
        //         'message' => trans('lang.mobile_already_exist'),
        //         'object' => (object) [],
        //     ]);
        // }
        $updateData = array("firstName" => $request->firstName,
            "lastName" => $request->lastName);
        $data = User::where('id', $user_id)->where('status', 1)
            ->update($updateData);
        if ($data) {

            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' =>  trans('lang.update_profile'),
                'object' => (object) [],
            ]);
        } else {

            return response()->json([

                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => trans('lang.please_try_again'),
                'object' => (object) [],
            ]);
        }

    }
    public function updateOwnerProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'firstName' => 'required',
            'lastName' => 'required',
            // 'mobileNo' => 'required',
             'propertyIdentity' => 'required',
            'operatingLicense' => 'required',

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
        $user_id = $user->id;
        // if ($this->driver->profileUpdateMobileNumber($user_id, $request->mobileNo) == true) {

        //     return response()->json([
        //         'status' => Controller::HTTP_BAD_REQUEST,
        //         'message' => trans('lang.mobile_already_exist'),
        //         'object' => (object) [],
        //     ]);
        // }
        $updateData = array("firstName" => $request->firstName,
            "lastName" => $request->lastName,
            // "mobileNo" => $request->mobileNo,
            "propertyIdentity" => $request->propertyIdentity,
        "operatingLicense" => $request->operatingLicense);
        $data = User::where('id', $user_id)->where('status', 1)
            ->update($updateData);
        if ($data) {

            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' =>  trans('lang.update_profile'),
                'object' => (object) [],
            ]);
        } else {

            return response()->json([

                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => trans('lang.please_try_again'),
                'object' => (object) [],
            ]);
        }

    }
    public function updateProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'image' => 'required',

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
        $user_id = $user->id;
        if (!empty($request->file('image'))) {

            $image = $request->file('image');
            $imgName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/user-profile/');
            $image->move($destinationPath, $imgName);

            $imageName = $imgName;
            $updateData = array("image" => $imageName,
            );
            $data = User::where('id', $user_id)->where('status', 1)
                ->update($updateData);
                $data = User::select("image")->where('id', $user_id)->where('status', 1)->get();
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.update_profile'),
                'object' => array("rows"=>$data),
            ]);
        } else {
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => trans('lang.please_try_again'),
                'object' => (object) [],
            ]);
        }

    }

}
