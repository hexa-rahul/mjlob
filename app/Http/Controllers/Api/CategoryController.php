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

class CategoryController extends Controller
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
    
    public function getCategoryByParentId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'parent_id' => 'required',
        ]);
        if($validator->fails()) {
            
            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }

        $user        = Auth::user();
        $user_id     = $user->id;
        $parent_id   = $request->parent_id;
        $response    = MasterCategory::where('parent_id', $parent_id)->where('deleted_at', null)->latest()->paginate();
        
        return $this->responseData->arrayHTTPOK(trans('lang.category_list'),$response);

    }

    public function getAllCategory(Request $request)
    {
        $response    = MasterCategory::where('deleted_at', null)->latest()->get();
        return $this->responseData->arrayHTTPOK(trans('lang.category_list'),$response);
    }

    public function likeUnliked(Request $request){

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',

        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }

        $user            = Auth::user();
        $user_id         = $user->id;
        $likedata        = array("user_id" => $user_id, "category_id" => $request->category_id);
        $isLiked         = FavouriteCategory::where($likedata)->count();
        if($isLiked>0){
            
            FavouriteCategory::where($likedata)->delete();
            
            return response()->json([
                'status'  => Controller::HTTP_OK,
                'message' => "Unliked successfully",
                'data'    => (object) [],
            ]);
        }else{

            $isCategory = MasterCategory::where('id', $request->category_id)->count(); 
            if($isCategory>0){

                $UserLikeCategory =  FavouriteCategory::create($likedata);

                if($UserLikeCategory){
                    return response()->json([
                        'status'  => Controller::HTTP_OK,
                        'message' => "Liked successfully",
                        'data'    => array("category_data" => $UserLikeCategory),
                    ]);
                }
            }else {
                return response()->json([
                    'status'  => Controller::HTTP_OK,
                    'message' => trans('lang.Category data not found'),
                    'object'  => array("category_data" => array()),
                ]);
            }
        }

    }
    
    // FOR GET FAVOURITE CATEGORY 
    public function getfavCategory(Request $request){
        
        $user              =  Auth::user();
        $user_id           =  $user->id;
        $category_ids      =  FavouriteCategory::where('user_id', $user_id)->where('deleted_at',null)->pluck('category_id');
        $UserLikeCategory  =  MasterCategory::whereIn('id',$category_ids)->get();

        if($UserLikeCategory->count()>0){
            
            return response()->json([
                    'status' => Controller::HTTP_OK,
                    'message' => "Liked Category List",
                    'data' => array("category_data" => $UserLikeCategory),
                ]);

        }else{
            
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => trans('lang.category_data_not_found'),
                'object' => array("category_data" => array()),
            ]);
        }

    }
}