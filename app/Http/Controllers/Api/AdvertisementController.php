<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ItemMedia;
use App\Models\ItemAdvertisement;
use App\Services\ExistingClass;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Services\responseData;
use Illuminate\Support\Facades\File;
use Validator;
use Carbon\Carbon;

class AdvertisementController extends Controller
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
    //CREATE NEW ADS 
    public function addAds(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id'  => 'required',
            'name'         => 'required',
            'description'  => 'required',
            'prize'        => 'required',
            'type'         => 'required',
            'google_map_link' => 'required',
            'address'      => 'required',
            'country'      => 'required',
            
        ]);
        if ($validator->fails()) {
            
            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }

        $user              = Auth::user();
        $input             = $request->all();
        $input['user_id']  = $user->id;

        $response          = ItemAdvertisement::create($input);

        if($response){

            return $this->responseData->objectHTTPOK(trans('lang.ads_sucess'),$response);
        } else {

            return $this->responseData->httpbadREQUEST(trans('lang.error_msg'));
        }
    }
    //FOR GET ADVERTISEMENT LIST
    public function getAdvertisements(Request $request){

        $user              = Auth::user();
        $response          = ItemAdvertisement::where('user_id', $user->id)->latest()->paginate();
        
        if($response){

            return $this->responseData->arrayHTTPOK(trans('lang.ads_list'),$response);
        } else {

            return $this->responseData->httpbadREQUEST(trans('lang.error_msg'));
        }
    }
    //FOR GET ADVERTISEMENT DETAIL
    public function getDetail(Request $request){
        
        $validator = Validator::make($request->all(), [
            'advertisement_id'  => 'required',
        ]);
        if ($validator->fails()) {
            
            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }
        
        $advertisement_id  = $request->advertisement_id; 
        $user              = Auth::user();
        $response          = ItemAdvertisement::where('id', $advertisement_id)->where('user_id', $user->id)->first();
        
        if($response){

            return $this->responseData->objectHTTPOK(trans('lang.ads_detail'),$response);
        } else {

            return $this->responseData->httpbadREQUEST(trans('lang.data_not_found'));
        }
    }
    //FOR DELETE ADVERTISEMENT
    public function deleteAds(Request $request){

        $validator = Validator::make($request->all(), [
            'advertisement_id'  => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }

        $dt = Carbon::now();
        $dt->toDateTimeString();

        $advertisement_id     = $request->advertisement_id; 
        $user                 = Auth::user();
        $adresponse           = ItemAdvertisement::where('id', $advertisement_id)->where('user_id', $user->id)->count();
        if($adresponse==0){

            return $this->responseData->httpbadREQUEST(trans('lang.error_msg'));
        }
        $response             = ItemAdvertisement::where('id', $advertisement_id)->where('user_id', $user->id)->first();
        $response->deleted_at = Carbon::now();
        $response->save();

        if($response){
            $response         = (object) [];
            return $this->responseData->objectHTTPOK(trans('lang.delete_success'),$response);
        } else {

            return $this->responseData->httpbadREQUEST(trans('lang.error_msg'));
        }
    }
    //FOR EDIT ADVERTISEMENT
    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'advertisement_id' => 'required',
            'category_id'  => 'required',
            'name'         => 'required',
            'description'  => 'required',
            
            'price'        => 'required',
            
            'type'         => 'required',
            'google_map_link' => 'required',
            'address'      => 'required',
            'country'      => 'required',
         
        ]);
        if ($validator->fails()) {
            
            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }

        $user     = Auth::user();
        $update   = ItemAdvertisement::where('id', $request->advertisement_id)
                                     ->update([
                                                'category_id'  => $request->category_id,
                                                'name'         => $request->name,
                                                'description'  => $request->description,
                                                'reference_id' => $request->reference_id,
                                                'prize'        => $request->prize,
                                                'size'         => $request->size,
                                                'type'         => $request->type,
                                                'google_map_link' => $request->google_map_link,
                                                'address'      => $request->google_map_link,
                                                'country'      => $request->country,
                                                'is_promoted'  => $request->is_promoted,
                                                'is_published' => $request->is_published,
                                                'latitude'     => $request->latitude,
                                                'longitude'    => $request->longitude,

                                               ]);    
        if($update){
            
            $response   = ItemAdvertisement::where('id', $request->advertisement_id)->first();
            return $this->responseData->objectHTTPOK(trans('lang.update_success'), $response);
        } else {

            return $this->responseData->httpbadREQUEST(trans('lang.error_msg'));
        }                                     
            
    }
    //UPLOAD MULTIPLE IMAGES
     public function uploadADsImages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ads_item_id'  => 'required',
            'image'   => 'required',
        ]);
        if ($validator->fails()) {
            
            $errors = $validator->errors()->toArray();
            return $this->responseData->httpbadREQUEST(reset($errors)[0]);
        }

        $user                  = Auth::user();
        $ads_images            = $request->file('image');

        foreach ($request->file('image') as $key => $value) {
            
            
            

            $image           = $request->file('image')[$key];
            $imgName         = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/user-profile/');

            $image->move($destinationPath, $imgName);
            $response          = ItemMedia::create(['ads_item_id' => 1,
                                                    'file_name'   => $imgName, 
                                                    'media_type'  =>'image',
                                                    'user_id'     => $user->id,
                                                    
                                                  ]);    
        }

        if($response){
            
            $response = (object) []; 
            return $this->responseData->objectHTTPOK(trans('lang.ads_sucess'),$response);
        } else {

            return $this->responseData->httpbadREQUEST(trans('lang.error_msg'));
        }
    }


}