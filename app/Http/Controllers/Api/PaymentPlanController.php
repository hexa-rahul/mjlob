<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Models\UserPlan;
use Auth;
use Illuminate\Http\Request;
use Validator;

class PaymentPlanController extends Controller
{
    //
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetail()
    {

        $user = Auth::user();
        if ($user) {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' =>  trans('lang.user_details'),
                'object' => $user,
            ]);
        } else {

            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' =>  trans('lang.user_error'),
                'object' => (object) [],
            ]);
        }
    }
    public function getplanlist()
    {

        $SubscriptionPlanlist = SubscriptionPlan::select("id","duration","cost","name","descriptions","plan_expiry_date","created_at","updated_at","deleted_at")->where("status", 1)->get();
        if ($SubscriptionPlanlist) {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => array("rows" => $SubscriptionPlanlist),

            ]);
        } else {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows" => array()),

            ]);
        }
    }
    public function getplanlistAr()
    {

        // $SubscriptionPlanlist = SubscriptionPlan::select("id","duration","costAr","nameAr","descriptionsAr","plan_expiry_date","created_at","updated_at","deleted_at")->where("status", 1)->get();
        $SubscriptionPlanlist = SubscriptionPlan::where("status", 1)->get();
        if ($SubscriptionPlanlist) {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => array("rows" => $SubscriptionPlanlist),

            ]);
        } else {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows" => array()),

            ]);
        }
    }
    public function SaveUserPlan(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'plan_id' => 'required',
            'transaction_id' => 'required',
            'plan_expire_date' => 'required',

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
        $planData = array(
            "user_id" => $user_id,
            "plan_id" => $request->plan_id,
            "plan_expire_date" => $request->plan_expire_date,
            "transaction_id" => $request->transaction_id);
        $UserPlaninfo = UserPlan::create($planData);
        if ($UserPlaninfo) {
            $data = UserPlan::where('id', $UserPlaninfo->id)->where('status', 1)->first();
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
    public function updateUserPlanold(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',

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
        UserPlan::where('user_id', $user_id)->update(["is_active_plan" => 0]);
        $UserPlaninfo = UserPlan::where('transaction_id', $request->transaction_id)->update(["is_active_plan" => 1]);

        if ($UserPlaninfo) {
            $data = UserPlan::where('transaction_id', $request->transaction_id)->where('status', 1)->first();
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.update_subscription'),
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
    public function updateUserPlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'is_active_plan' => 'required',
            'plan_expire_date' => 'required',

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
        $data = UserPlan::where('user_id', $user_id)->update(["is_active_plan" => $request->is_active_plan,"plan_expire_date"=> $request->plan_expire_date]); 
        if ($data) {
            $data = UserPlan::where('user_id', $user_id)->where('status', 1)->first();
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.update_subscription'),
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
