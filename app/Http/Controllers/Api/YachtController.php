<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Models\YachtAccommodationData;
use App\Models\YachtAvailableDate;
use App\Models\YachtAvailableDateTime;
use App\Models\YachtCrewData;
use App\Models\YachtFavorite;
use App\Models\YachtFeaturesData;
use App\Models\YachtList;
use App\Models\YachtPhotos;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PushService;
use Validator;
use DB;

class YachtController extends Controller
{
    //
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
         $this->PushService    = new PushService();
    }
    public function addYacht(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'yachtName' => 'required',

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

        $input = $request->all();
        $addyachlist = array("user_id" => $user_id,
            "yachtName" => $request->yachtName,
            "passengers" => $request->passengers,
            "meter" => $request->meter,
            "cabins" => $request->cabins,
            "crews" => $request->crews,
            "address" => $request->address,
            "city" => $request->city,
            "country" => $request->country,
            "countryId" => $request->countryId,
            "categoryId" => $request->categoryId,
            "longitude" => $request->latitude,
            "longitude" => $request->longitude,
            "generalInfoLength" => $request->generalInfoLength,
            "generalInfoBeam" => $request->generalInfoBeam,
            "generalInfoDraft" => $request->generalInfoDraft,
            "generalInfoGrossTonnage" => $request->generalInfoGrossTonnage,
            "builder" => $request->builder,
            "yearOfBuild" => $request->yearOfBuild,
            "maxspeed" => $request->maxspeed,
            "cruisingSpeed" => $request->cruisingSpeed,
            "fuelConsumption" => $request->fuelConsumption,
            "gasoilTank" => $request->gasoilTank,
            "EngineManufacturer" => $request->EngineManufacturer,
            "EngineModel" => $request->EngineModel,
            "EngineType" => $request->EngineType,
            "EngineTotalpower" => $request->EngineTotalpower,
            "EngineQuantity" => $request->EngineQuantity,
            "yachtPrice" => $request->yachtPrice,
        );
        $yachData = YachtList::create($addyachlist);
        $accommodationData = json_decode($request->accommodation, true);
        if (is_array($accommodationData)) {
            foreach ($accommodationData as $accommodation) {
                $addAccommodationData['userId'] = $user->id;
                $addAccommodationData['yachId'] = $yachData->id;
                $addAccommodationData['accomodationName'] = $accommodation["accomodationName"];
                $addAccommodationData['amount'] = $accommodation["amount"];
                $addGroup = YachtAccommodationData::create($addAccommodationData);
            }
        }

        $featuresData = json_decode($request->features, true);
        if (is_array($featuresData)) {
            foreach ($featuresData as $f) {
                $addGroupData['userId'] = $user->id;
                $addGroupData['yachId'] = $yachData->id;
                $addGroupData['featuresName'] = $f["featuresName"];
                $addGroup = YachtFeaturesData::create($addGroupData);
            }
        }
        $crewData = json_decode($request->crew, true);
        if (is_array($crewData)) {
            foreach ($crewData as $crew) {
                $addcrewData['userId'] = $user->id;
                $addcrewData['yachId'] = $yachData->id;
                $addcrewData['crewName'] = $crew["crewName"];
                $addcrewData['crewType'] = $crew["crewType"];
                $addGroup = YachtCrewData::create($addcrewData);
            }
        }
        $media_filedata = json_decode($request->media_filedata, true);
        if (is_array($media_filedata)) {
            foreach ($media_filedata as $media) {
                $input['yachtPhoto'] = $media;
                $input['yachtId'] = $yachData->id;
                $input['userId'] = $user->id;
                YachtPhotos::create($input);
            }
        }
        if ($yachData) {
            $data = YachtList::with(['accommodationData', 'featuresData', 'crewData', 'yachtPhotos','categoryData'])->where('id', $yachData->id)->where('status', 1)->get();
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => array("rows"=>$data),

            ]);
        } else {

            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows"=>array()),

            ]);
        }

    }
    public function addYachtPhotos(Request $request)
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
                $destinationPath = public_path('/uploads/yachtphotos/');
                $image->move($destinationPath, $imgName);
                array_push($uplodephotos, $imgName);
            }
        }
        if ($uplodephotos > 0) {

            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.yacht_photo_upload'),
                'data' => array("rows"=>$uplodephotos),
            ]);
        } else {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows"=> array()),
            ]);
        }

    }
    public function getYachtList(Request $request)
    {

        $user = Auth::user();
        if ($request->noOfYacht !== 0) {
            $skip = $request->pageNo * $request->noOfYacht;
        }
        $user_id = $user->id;
        $counry = $request->counry;
        $query = YachtList::query();
        if ($request->counry != "") {
            $query = $query->where('country', '=', $request->country);
        }
        if ($request->city != "") {
            $query = $query->where('city', 'LIKE', '%' . $request->city . '%');
        }

        // $getYachtList = YachtList::with(['accommodationData', 'featuresData', 'crewData'])
        //     ->where('counry', $request->counry)

        //     ->where('counry', $request->city)
        //     ->orderBy('id', 'DESC')
        //     ->offset($skip)->limit($request->noOfYacht)
        //     ->get();
        //     ->whereHas('accommodationData', function ($query) {
        //         $query->where('status', '=', '1');
        //     })->whereHas('featuresData', function ($query) {
        //     $query->where('status', '=', '1');
        // })->whereHas('crewData', function ($query) {
        //     $query->where('status', '=', '1');
        // })->whereHas('yachtPhotos', function ($query) {
        //     $query->where('status', '=', '1');
        // })

        $getYachtList = $query->with([
            'accommodationData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'featuresData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'crewData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'yachtPhotos' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'categoryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'countryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }]) ->select("yachtlist.*",DB::Raw('IFNULL(`yacht_favorite_list`.`isfavorite` , 0 ) as isfavorite'))
        ->leftJoin("yacht_favorite_list", function ($query) use ($user_id) {
            $query->on('yacht_favorite_list.yachtId', '=', 'yachtlist.id')->where('yacht_favorite_list.userId', '=', $user_id);
        })
            ->offset($skip)->limit($request->noOfYacht)->where("yachtlist.status", '=', '1')->get();
			
		if ($getYachtList->count() > 0) {
			
			$query = YachtList::query();
        if ($request->counry != "") {
            $query = $query->where('country', '=', $request->country);
        }
        if ($request->city != "") {
            $query = $query->where('city', 'LIKE', '%' . $request->city . '%');
        }
        $recordsTotal = $query->with([
            'accommodationData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'featuresData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'crewData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'yachtPhotos' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'categoryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'countryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }])->where("yachtlist.status", '=', '1')->count();
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.yacht_list'),
                'data' => array("rows"=>$getYachtList,'recordsTotal'=>$recordsTotal),
            ]);
        }

        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.yacht_not_found'),
            'object' => array("rows"=> array()),
        ]);
    }
    public function yachtListByCountry(Request $request)
    {
        $user_id = "";
        $yachtListByCountry = Country::withCount("YachtList")->whereHas('YachtList', function ($query) {
            $query->where('status', '=', '1');
        })
        // ->select("country.countryName","country.image")
            ->where("country.status", 1)
            ->orderBy('country.position', 'ASC')
            ->get();
        if ($yachtListByCountry) {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.yacht_list'),
                'data' => array("rows"=>$yachtListByCountry),
            ]);
        } else {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' =>array("rows"=> array()),
            ]);
        }

    }
    public function yachtList(Request $request)
    {

        $user = Auth::user();
        
        if(isset($user)){
         $user_id = $user->id;
        }
        else{
            $user_id = 0;
        }
        if ($request->noOfYacht !== 0) {
            $skip = $request->pageNo * $request->noOfYacht;
        }
        $countryId = $request->countryId;
        $query = YachtList::query();
        if ($request->countryId != "") {
            $query = $query->where('yachtlist.countryId', '=', $request->countryId);
        }
        if ($request->city != "") {
            $query = $query->where('yachtlist.city', 'LIKE', '%' . $request->city . '%');
        }
        if ($request->categoryId != "") {
            $query = $query->where('yachtlist.categoryId', '=', $request->categoryId);
        }
        if($request->min_price && $request->max_price){
            // This will only executed if you received any price
            // Make you you validated the min and max price properly
            $query = $query->where('yachtlist.yachtPrice','>=',$request->min_price);
            $query = $query->where('yachtlist.yachtPrice','<=',$request->max_price);
        }
        // $query = $query->where('status', '=', 1);
        $getYachtList = $query->with([
            'accommodationData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'featuresData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'crewData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'yachtPhotos' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'categoryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'countryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }])->select("yachtlist.*",DB::Raw('IFNULL(`yacht_favorite_list`.`isfavorite` , 0 ) as isfavorite'))
        ->leftJoin("yacht_favorite_list", function ($query) use ($user_id) {
            $query->on('yacht_favorite_list.yachtId', '=', 'yachtlist.id')->where('yacht_favorite_list.userId', '=', $user_id);
        })
            ->where("yachtlist.status", '=', '1')
            ->offset($skip)->limit($request->noOfYacht)->get();
        if ($getYachtList->count() > 0) {
			$query = YachtList::query();
        if ($request->countryId != "") {
            $query = $query->where('yachtlist.countryId', '=', $request->countryId);
        }
        if ($request->city != "") {
            $query = $query->where('yachtlist.city', 'LIKE', '%' . $request->city . '%');
        }
        if ($request->categoryId != "") {
            $query = $query->where('yachtlist.categoryId', '=', $request->categoryId);
        }
        if($request->min_price && $request->max_price){
            // This will only executed if you received any price
            // Make you you validated the min and max price properly
            $query = $query->where('yachtlist.yachtPrice','>=',$request->min_price);
            $query = $query->where('yachtlist.yachtPrice','<=',$request->max_price);
        }
			$recordsTotal = $query->with([
            'accommodationData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'featuresData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'crewData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'yachtPhotos' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'categoryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'countryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }])->where("yachtlist.status", '=', '1')->count();
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => 'Yacht List',
                'data' => array("rows"=>$getYachtList,"recordsTotal"=>$recordsTotal),
            ]);
        }

        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.please_try_again'),
            'data' =>  array("rows"=> array()),
        ]);
    }
    public function yatchDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'yachtId' => 'required',

        ]);
        $user = Auth::user();
        if(isset($user)){
            $user_id = $user->id;
           }
           else{
               $user_id = 0;
           }
        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $yachtId = $request->yachtId;
        $data = YachtList::with(['user_detail'=> function ($query) use ($request) {
                $query->where('status', 1);
            }, 'accommodationData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'featuresData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'crewData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'yachtPhotos' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'categoryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'countryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }])->select("yachtlist.*",DB::Raw('IFNULL(`yacht_favorite_list`.`isfavorite` , 0 ) as isfavorite'))
            ->leftJoin("yacht_favorite_list", function ($query) use ($user_id) {
                $query->on('yacht_favorite_list.yachtId', '=', 'yachtlist.id')->where('yacht_favorite_list.userId', '=', $user_id);
            })
            ->where('yachtlist.id', $yachtId)->where('yachtlist.status', 1)->get();
        if ($data) {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => array("rows"=> $data),

            ]);
        } else {

            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows"=> array()),

            ]);
        }

    }
    public function AddYachtAvailableTime(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'yachtId' => 'required',
            'date' => 'required',
            'time' => 'required',

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
        $yachtId = $request->yachtId;
        $isYachtAvailableDate = YachtAvailableDate::where('yachtId', $request->yachtId)->where("date",$request->date)->where('status', 1)->get();
        if ($isYachtAvailableDate->count() < 1) {
            $addyachldate = array("yachtId" => $request->yachtId,
                "userId" => $user_id,
                "date" => $request->date);
            $data = YachtAvailableDate::create($addyachldate);
            $isYachtAvailableDateId = $data->id;
        } else {
            $isYachtAvailableDateId = $isYachtAvailableDate[0]->id;
        }
        $timeData = json_decode($request->time, true);
        foreach ($timeData as $time) {
            $addtimeData['userId'] = $user->id;
            $addtimeData['AvailableDateId'] = $isYachtAvailableDateId;
            $addtimeData['date'] = $request->date;
            $addtimeData['yachtId'] = $yachtId;
            $addtimeData['startTime'] = $time["startTime"];
            $addtimeData['endTime'] = $time["endTime"];
            YachtAvailableDateTime::create($addtimeData);
        }
        $data = YachtAvailableDate::with(['AvailableDateTime'])->where('yachtId', $yachtId)->where('status', 1)->get();
        if ($data) {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.available_time_added'),
                'data' => array("rows"=> $data),

            ]);
        } else {

            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows"=> array()),

            ]);
        }

    }
    public function getYachtAvailableTime(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'yachtId' => 'required',
            'date' => 'required',

        ]);
        $user = Auth::user();
        if(isset($user)){
            $user_id = $user->id;
           }
           else{
               $user_id = 0;
           }
        
        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $yachtId = $request->yachtId;
        $Month = $request->month;
        $data = YachtAvailableDate::with(['AvailableDateTime'=> function ($query) use ($request) {
            // $query->whereRaw('MONTH(date) = ?', $request->month);
            $query->where('date', $request->date);
        }])->where('yachtId', $yachtId) ->where('date', $request->date)->where('status', 1)->get();
        if ($data) {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.available_time_list'),
                'data' => array("rows"=> $data),

            ]);
        } else {

            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'object' => array("rows"=> array()),

            ]);
        }

    }
    public function removeYachtAvailableTime(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'yachtId' => 'required',
            'YachtAvailableTimeId' => 'required',

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

        $yachtId = $request->yachtId;
         $YachtAvailableDateTimeData = YachtAvailableDateTime::where('id', $request->YachtAvailableTimeId)->where('status', 1)->get();
        if ($YachtAvailableDateTimeData->count() > 0) {
            $updateData = YachtAvailableDateTime::where('id', $request->YachtAvailableTimeId)->where('userId', $user_id)->where('yachtId', $yachtId)->update(['status' => 0, "deleted_at" => Carbon::now()]);
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.Yacht available time removed'),
                'data' => array("rows"=> array()),
            ]);

        } else {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' =>  trans('lang.Yacht Available time not found'),
                'data' => array("rows"=> array()),
            ]);
            }       

    }
    public function ownerYachtList(Request $request)
    {

        $user = Auth::user();
        if ($request->noOfYacht !== 0) {
            $skip = $request->pageNo * $request->noOfYacht;
        }
        $user_id = $user->id;
        $countryId = $request->countryId;
        $query = YachtList::query();
        if ($request->countryId != "") {
            $query = $query->where('yachtlist.countryId', '=', $request->countryId);
        }
        if ($request->city != "") {
            $query = $query->where('yachtlist.city', 'LIKE', '%' . $request->city . '%');
        }
        // $query = $query->where('status', '=', 1);
        $getYachtList = $query->with([
            'accommodationData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'featuresData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'crewData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'yachtPhotos' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'categoryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'countryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }])
        ->select("yachtlist.*",DB::Raw('IFNULL(`yacht_favorite_list`.`isfavorite` , 0 ) as isfavorite'))
        ->leftJoin("yacht_favorite_list", function ($query) use ($user_id) {
            $query->on('yacht_favorite_list.yachtId', '=', 'yachtlist.id')->where('yacht_favorite_list.userId', '=', $user_id);
        })
            ->where("yachtlist.status", '=', '1')
            ->offset($skip)->limit($request->noOfYacht)
            ->where('yachtlist.user_id', '=', $user_id)
            ->get();
        if ($getYachtList->count() > 0) {
			$query = YachtList::query();
        if ($request->countryId != "") {
            $query = $query->where('yachtlist.countryId', '=', $request->countryId);
        }
        if ($request->city != "") {
            $query = $query->where('yachtlist.city', 'LIKE', '%' . $request->city . '%');
        }
        // $query = $query->where('status', '=', 1);
        $recordsTotal = $query->with([
            'accommodationData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'featuresData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'crewData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'yachtPhotos' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'categoryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }, 'countryData' => function ($query) use ($request) {
                $query->where('status', 1);
            }])
            ->where("yachtlist.status", '=', '1')
            ->where('yachtlist.user_id', '=', $user_id)
            ->count();

            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' =>  trans('lang.yacht_list'),
                'data' => array("rows"=> $getYachtList,"recordsTotal"=>$recordsTotal),
            ]);
        }

        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' =>  trans('lang.yacht_not_found'),
            'data' => array("rows"=> array()),
        ]);
    }
    public function deleteYacht(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'yachtId' => 'required',

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
        $yachtData = YachtList::where('id', $request->yachtId)->where('status', 1)->get();
        //print_r($yachtData->count());
        //->where('user_id',$user_id)
        if ($yachtData->count() > 0) {
            $updateData = YachtList::where('id', $request->yachtId)->where('user_id', $user_id)->update(['status' => 0, "deleted_at" => Carbon::now()]);
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.removed_yacht'),
                'data' => array("rows"=> array()),
            ]);

        } else {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' =>  trans('lang.yacht_not_found'),
                'data' => array("rows"=> array()),
            ]);
        }

    }
    public function updateYacht(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'yachtName' => 'required',
            'yachtId' => 'required',

        ]);
        $user = Auth::user();
        $user_id = $user->id;
        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'data' => (object) [],
            ]);
        }
        $yachtData = YachtList::where('id', $request->yachtId)->where('status', 1)->get();
        if ($yachtData->count() == 0) {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => 'Pass vaild Yacht id',
                'data' => array("rows"=> array()),
            ]);
        }

        $input = $request->all();
        $updateyachlist = array("user_id" => $user_id,
            "yachtName" => $request->yachtName,
            "passengers" => $request->passengers,
            "meter" => $request->meter,
            "cabins" => $request->cabins,
            "crews" => $request->crews,
            "address" => $request->address,
            "city" => $request->city,
            "country" => $request->country,
            "countryId" => $request->countryId,
            "categoryId" => $request->categoryId,
            "longitude" => $request->latitude,
            "longitude" => $request->longitude,
            "generalInfoLength" => $request->generalInfoLength,
            "generalInfoBeam" => $request->generalInfoBeam,
            "generalInfoDraft" => $request->generalInfoDraft,
            "generalInfoGrossTonnage" => $request->generalInfoGrossTonnage,
            "builder" => $request->builder,
            "yearOfBuild" => $request->yearOfBuild,
            "maxspeed" => $request->maxspeed,
            "cruisingSpeed" => $request->cruisingSpeed,
            "fuelConsumption" => $request->fuelConsumption,
            "gasoilTank" => $request->gasoilTank,
            "EngineManufacturer" => $request->EngineManufacturer,
            "EngineModel" => $request->EngineModel,
            "EngineType" => $request->EngineType,
            "EngineTotalpower" => $request->EngineTotalpower,
            "EngineQuantity" => $request->EngineQuantity,
            "yachtPrice" => $request->yachtPrice,
        );
        // DB::enableQueryLog();
        $uploaddata = YachtList::where('id', $request->yachtId)->where('user_id', $user_id)->update($updateyachlist);
        // $query = DB::getQueryLog();
        // $query = end($query);
        // print_r($query);
        // die();
         YachtAccommodationData::where('yachId', $request->yachtId)->where('userId', $user_id)->update(["status" => 0]);
        YachtFeaturesData::where('yachId', $request->yachtId)->where('userId', $user_id)->update(["status" => 0]);
        YachtCrewData::where('yachId', $request->yachtId)->where('userId', $user_id)->update(["status" => 0]);
        YachtPhotos::where('yachtId', $request->yachtId)->where('userId', $user_id)->update(["status" => 0]);
        $accommodationData = json_decode($request->accommodation, true);
        if (is_array($accommodationData)) {
            foreach ($accommodationData as $accommodation) {
                $addAccommodationData['userId'] = $user->id;
                $addAccommodationData['yachId'] = $request->yachtId;
                $addAccommodationData['accomodationName'] = $accommodation["accomodationName"];
                $addAccommodationData['amount'] = $accommodation["amount"];
                $addGroup = YachtAccommodationData::create($addAccommodationData);
            }
        }

        $featuresData = json_decode($request->features, true);
        if (is_array($featuresData)) {
            foreach ($featuresData as $f) {
                $addGroupData['userId'] = $user->id;
                $addGroupData['yachId'] = $request->yachtId;
                $addGroupData['featuresName'] = $f["featuresName"];
                $addGroup = YachtFeaturesData::create($addGroupData);
            }
        }
        $crewData = json_decode($request->crew, true);
        if (is_array($crewData)) {
            foreach ($crewData as $crew) {
                $addcrewData['userId'] = $user->id;
                $addcrewData['yachId'] = $request->yachtId;
                $addcrewData['crewName'] = $crew["crewName"];
                $addcrewData['crewType'] = $crew["crewType"];
                $addGroup = YachtCrewData::create($addcrewData);
            }
        }
        $media_filedata = json_decode($request->media_filedata, true);
        if (is_array($media_filedata)) {
            foreach ($media_filedata as $media) {
                $input['yachtPhoto'] = $media;
                $input['yachtId'] = $request->yachtId;
                $input['userId'] = $user->id;
                YachtPhotos::create($input);
            }
        }
        if ($uploaddata) {
            $data = YachtList::with([
                'accommodationData' => function ($query) use ($request) {
                    $query->where('status', 1);
                }, 'featuresData' => function ($query) use ($request) {
                    $query->where('status', 1);
                }, 'crewData' => function ($query) use ($request) {
                    $query->where('status', 1);
                }, 'yachtPhotos' => function ($query) use ($request) {
                    $query->where('status', 1);
                }, 'categoryData' => function ($query) use ($request) {
                    $query->where('status', 1);
                }, 'countryData' => function ($query) use ($request) {
                    $query->where('status', 1);
                }])
                ->where('id', $request->yachtId)->where('status', 1)->get();
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => array("rows"=> $data),

            ]);
        } else {

            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows"=> array()),

            ]);
        }

    }
    public function addTofavoriteYacht(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'yachtId' => 'required',
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
        $YachtFavoriteData = YachtFavorite::where('yachtId', $request->yachtId)->where('userId', $user_id)->get();
        if ($YachtFavoriteData->count() > 0) {
            $updateData = YachtFavorite::where('yachtId', $request->yachtId)->where('userId', $user_id)->update(['status' => 1,"isfavorite"=>1]);
        } else {
            $input = array("yachtId"=>$request->yachtId,
                        "userId" => $user_id,
                        "isfavorite"=>1);
            $updateData = YachtFavorite::create($input);
        }
        if ($updateData) {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.added_to_favorite'),
                'data' => array("rows"=> array()),
            ]);

        } else {

            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows"=> array()),

            ]);
        }

    }
    public function removeFavoriteYacht(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'yachtId' => 'required',
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
        $YachtFavoriteData = YachtFavorite::where('yachtId', $request->yachtId)->where('userId', $user_id)->get();
        if ($YachtFavoriteData->count() > 0) {
            $updateData = YachtFavorite::where('yachtId', $request->yachtId)->where('userId', $user_id)->update(['status' => 0,"isfavorite"=>0]);
        } else {
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("rows"=>array()),

            ]);
        }
        if ($updateData) {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.removed_to_favorite'),
                'data' => array("rows"=>array()),
            ]);

        } else {

            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' =>  array("rows"=>array()),

            ]);
        }

    }
    public function getFavoriteYachtList(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        if ($request->no_of_favorite !== 0) {
            $skip = $request->page_no * $request->no_of_favorite;
        }
        $PostLikeList = YachtFavorite::with(['Yachtdata'=> function ($query) use ($request) {
                    $query->where('status', 1);
                },'yachtPhotos' 
		=> function ($query) use ($request) {
                    $query->where('status', 1);
                }])
        ->whereHas('Yachtdata', function ($query) {
            $query->where('yachtlist.status', '=', '1');
        })->whereHas('yachtPhotos', function ($query) {
            $query->where('yacht_photos.status', '=', '1');
        })
        ->where('status', 1)
        ->where('userId', $user_id)
            ->offset($skip)->limit($request->no_of_favorite)->get();
        if ($PostLikeList->count() > 0) {
			
			$recordsTotal = YachtFavorite::with(['Yachtdata'=> function ($query) use ($request) {
                    $query->where('status', 1);
                },'yachtPhotos' 
		=> function ($query) use ($request) {
                    $query->where('status', 1);
                }])
        ->whereHas('Yachtdata', function ($query) {
            $query->where('yachtlist.status', '=', '1');
        })->whereHas('yachtPhotos', function ($query) {
            $query->where('yacht_photos.status', '=', '1');
        })
        ->where('status', 1)
        ->where('userId', $user_id)->count();
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' =>  array("rows"=> $PostLikeList,"recordsTotal"=>$recordsTotal),
            ]);
        }
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => 'No Like List',
            'data' =>  array("rows"=>array()),

        ]);
    }
    public function testsendNotification(Request $request){
        $messageData                  = array();
                $message                  = "You have login Successfully.";  
        $this->PushService->sendPushNotification(71,$message,$messageData);
        
    }

}
