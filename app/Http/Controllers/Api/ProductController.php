<?php

namespace App\Http\Controllers\Api;

use App;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ItemAdvertisement;
use App\Models\ItemFavourite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class ProductController extends Controller
{
    //
    public $globalLanguages;
    public function __construct(Request $request)
    {
        $this->globalLanguages = $local = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : 'en';
        if ($this->globalLanguages == "") {
            $this->globalLanguages = 'en';
        }
        // set laravel localization
        app()->setLocale($local);
    }

    //FOR GET PRODUCTS
    public function getProducts(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'page_no'       => 'required',
        //     'no_of_product' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $errors = $validator->errors()->toArray();
        //     return response()->json([
        //         'status' => Controller::HTTP_BAD_REQUEST,
        //         'message' => reset($errors)[0],
        //         'object' => (object) [],
        //     ]);
        // }
        $page_no        = ($request->page_no)?$request->page_no:0;
        $no_of_product  = ($request->no_of_product)?$request->no_of_product:10;
        $user_id        ='';
        $sort_by        = ($request->sort_by)?$request->sort_by:'';
        $title          = ($request->name)?$request->name:'';
        $minPrice       = ($request->min_price)?$request->min_price:'';
        $maxPrice       = ($request->max_price)?$request->max_price:'';
        $minBedroods    = ($request->min_bedroom)?$request->min_bedroom:'';
        $maxBedrooms    = ($request->max_bedroom)?$request->max_bedroom:'';

        return $this->filtterProducts($page_no,$no_of_product,$user_id,$title,$request->category_id,$request->sub_category_id,$request->sub_sub_category_id,$request->price,$request->product_type,$sort_by,$minPrice,$maxPrice,$minBedroods,$maxBedrooms);
    }
    
    public function likeUnliked(Request $request){

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',

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
        $likedata        = array("user_id" => $user_id, "item_id" => $request->product_id);
        $isLiked         = ItemFavourite::where($likedata)->count();
        if($isLiked>0){
            
            ItemFavourite::where($likedata)->delete();
            
            return response()->json([
                'status'  => Controller::HTTP_OK,
                'message' => "Unliked successfully",
                'data'    => (object) [],
            ]);
        }else{

            $isProduct = ItemAdvertisement::where('id', $request->product_id)->count(); 
            if($isProduct>0){

                $UserLikeProduct =  ItemFavourite::create($likedata);

                if($UserLikeProduct){
                    return response()->json([
                        'status'  => Controller::HTTP_OK,
                        'message' => "Liked successfully",
                        'data'    => array("product_data" => $UserLikeProduct),
                    ]);
                }
            }else {
                return response()->json([
                    'status'  => Controller::HTTP_OK,
                    'message' => trans('lang.Product Data not found'),
                    'object'  => array("product_data" => array()),
                ]);
            }
        }

    }
    
    public function getFavourite(Request $request){
        
        $user            =  Auth::user();
        $user_id         =  $user->id;
        $product_ids     =  ItemFavourite::where('user_id', $user_id)->where('deleted_at',null)->pluck('item_id');
        $UserLikeProduct =  ItemAdvertisement::whereIn('id',$product_ids)->get();

        if($UserLikeProduct->count()>0){
            
            return response()->json([
                    'status' => Controller::HTTP_OK,
                    'message' => "Liked Product List",
                    'data' => array("product_data" => $UserLikeProduct),
                ]);

        }else{
            
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => trans('lang.product_data_not_found'),
                'object' => array("product_data" => array()),
            ]);
        }

    }

    public function category_list(Request $request)
    {
        $statusDropdown = Category::with("sub_category_data")->where("status", 1)->orderBy('id', 'ASC')->get();
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.Category List'),
            'data' => array("category" => $statusDropdown),

        ]);
    }
    public function product_config(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'latitude' => 'required',
        //     'longitude' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $errors = $validator->errors()->toArray();
        //     return response()->json([
        //         'status' => Controller::HTTP_BAD_REQUEST,
        //         'message' => reset($errors)[0],
        //         'object' => (object) [],
        //     ]);
        // }

        // $distance = 20;
        // $location_list =  DB::table("cities")
        // ->select("*", DB::raw("6371 * acos(cos(radians(" . $request->latitude . "))
        // * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $request->longitude . "))
        // + sin(radians(" .$request->latitude. ")) * sin(radians(latitude))) AS distance"))
        // ->having('distance', '<', $distance)
        // ->get();
        
        $location_list = Citie::get();

        $statusDropdown = Category::with("sub_category_data.sub_subcategory_data")->where("status", 1)->orderBy('id', 'ASC')->get();
        return response()->json([
            'status' => Controller::HTTP_OK,
            'message' => trans('lang.Category List'),
            'data' => array("location_list"=>$location_list,"category" => $statusDropdown),
        ]);
    }
    public function location_list(Request $request)
    {
        $statusDropdown = Category::where("status", 1)->where("translation_lang", $this->globalLanguages)->orderBy('id', 'ASC')->get();
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.Category List'),
            'data' => array("category" => $statusDropdown),

        ]);
    }
    public function sub_category_list(Request $request)
    {
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

        $SubCategory = SubCategory::where("status", 1)->where("category_id", $request->category_id)->where("translation_lang", $this->globalLanguages)->orderBy('id', 'ASC')->get();
        $SubsubCategory = SubSubCategories::where("status", 1)->where("category_id", $request->category_id)->where("translation_lang", $this->globalLanguages)->orderBy('id', 'ASC')->get();
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.Sub Category List'),
            'data' => array("sub_category" => $SubCategory, "sub_sub_category" => $SubsubCategory),

        ]);
    }
    
    public function add_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name'        => 'required',
            'price'               => 'required',
            'product_description' => 'required',
            'category_id'         => 'required',
            'sub_category_id'     => 'required',
            'currency_code'       => 'required',
            'country_code'        => 'required',
            'location_ids'        => 'required',
            
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }

     return    $user                         = Auth::user();
        $user_id                      = $user->id;
        $input                        = $request->all();
        $input["user_id"]             = $user_id;
        $input["sub_sub_category_id"] = ($request->sub_sub_category_id)?$request->sub_sub_category_id:0;
        if($request->product_type=='shop_now'){
            
            $input["remaining_time"]  = '';
            $input["auctions_type"]   = '';
            $input["start_time"]      = '';
            $input["end_time"]        = '';

        }if($request->product_type=='auctions'){
            
            $validator = Validator::make($request->all(), [
                'auctions_type'       => 'required'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();
                return response()->json([
                    'status' => Controller::HTTP_BAD_REQUEST,
                    'message' => reset($errors)[0],
                    'object' => (object) [],
                ]);
            }

return $request->auctions_type; die;
            if($request->auctions_type=='upcomimg'){

                $input["remaining_time"]  = '';

            }else if($request->auctions_type=='live'){
                
                $input["end_time"]        = '';
                $input["start_time"]      = '';
            }else{

                return response()->json([
                    'status' => Controller::HTTP_BAD_REQUEST,
                    'message' => 'Invalid auction type, Plesae use valid key value.',
                    'data' => array("product_data" => array()),
                ]);
            }
        }else{

            return response()->json([
                'status'  => Controller::HTTP_BAD_REQUEST,
                'message' => 'Invalid product type, Plesae use valid key value.',
                'data'    => array("product_data" => array()),
            ]);
        }

        $product_data      = Product::create($input);


        $location_ids_array = explode(',', $request->location_ids);
        foreach ($location_ids_array as $location_id) {
            $category_data = array("product_id" => $product_data->id,
                "location_id" => $location_id);
            ProductLocation::create($category_data);
        }
        if (!empty($request->file('product_medias'))) {

            foreach ($request->file('product_medias') as $image) {
                $imgName = time() . '-' . $image->getClientOriginalName();
                $destinationPath = public_path('/uploads/media/');
                $image->move($destinationPath, $imgName);
                $imageName = $imgName;
                $addmedia["media_url"] = $imageName;
                $addmedia["user_id"] = $user_id;
                $addmedia["product_id"] = $product_data->id;
                $addmedia["created_date_timestamp"] = strtotime(Carbon::now());
                $mediaData = ProductMedia::create($addmedia);

            }
        }
        if ($product_data) {
            // with(['mallDetails','postPhotos','categoryData'])->
            $data = Product::with(['userinfo', 'main_category', 'product_media', 'location_data'])->where('id', $product_data->id)->where('status', 1)->get();
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => array("product_data" => $data),
            ]);
        } else {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'data' => array("product_data" => array()),
            ]);
        }
    }
    public function product_details(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',

        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $data = Product::with(['userinfo', 'main_category', 'product_media', 'location_data'])->where('id', $request->product_id)->where('status', 1)->first();

        foreach ($data->location_data as $key_place => $value_place) {
                        
            $placeName = Citie::where('id',$value_place->location_id)->first(['name_en','name_ar']);
            $data->location_data[$key_place]->name_en = $placeName->name_en;        
            $data->location_data[$key_place]->name_ar = $placeName->name_ar;        
        } 

        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.Product Data'),
            'data' => array("product_data" => $data),

        ]);
    }
    public function product_reviews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_no' => 'required',
            'no_of_reviews' => 'required',
            'product_id' => 'required',
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
        $user = Auth::user();
        if ($request->no_of_reviews !== 0) {
            $skip = $request->page_no * $request->no_of_reviews;
        }
        $user_id = $user->id;
        $data = ProductReview::where('product_id', $request->product_id)
            ->offset($skip)->limit($request->no_of_reviews)
            ->where('is_deleted', 0)->get();

        if ($data->count() > 0) {

            $recordsTotal = ProductReview::where('product_id', $request->product_id)
                ->where('is_deleted', 0)->count();
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.Product review list'),
                'data' => array("product_data" => $data, 'recordsTotal' => $recordsTotal),
            ]);
        }
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.Product List not found'),
            'object' => array("product_review_data" => array()),
        ]);
    }
    public function my_product_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_no' => 'required',
            'no_of_product' => 'required',
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
        // $start_date = $request->start_date;
        // $end_date = $request->end_date;
        // $start_date = date('Y-m-d 00:00:00', strtotime($request->start_date));
        // $end_date = date('Y-m-d 23:59:59', strtotime($request->end_date));
        $user = Auth::user();
        if ($request->no_of_product !== 0) {
            $skip = $request->page_no * $request->no_of_product;
        }

        $user_id = $user->id;
        $query = Product::query();
        // if ($request->start_date != "" && $request->end_date != "") {
        //      $query->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
        // }
        if ($request->title != "") {
            $query = $query->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->category_id != "") {
            $query->where('category_id', '=', $request->category_id);
        }

        if ($request->sub_category_id != "") {
            $query->whereHas('product_category', function ($query) use ($request) {
                $query->where('sub_category_id', '=', $request->sub_category_id);
            });
        }
        $data = $query->with(['userinfo', 'main_category', 'product_media', 'location_data'])
            ->where('user_id', $user_id)
            ->offset($skip)->limit($request->no_of_product)
            ->where('is_deleted', 0)->get();

        if ($data->count() > 0) {
            $query = Product::query();
            if ($request->category_id != "") {
                $query->where('category_id', '=', $request->category_id);
            }
            if ($request->sub_category_id != "") {
                $query->whereHas('product_category', function ($query) use ($request) {
                    $query->where('sub_category_id', '=', $request->sub_category_id);
                });
            }
            if ($request->title != "") {
                $query = $query->where('title', 'LIKE', '%' . $request->title . '%');
            }
            if ($request->start_date != "" && $request->end_date != "") {
                $query->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
            }
            $recordsTotal = $query->with(['userinfo', 'main_category', 'product_media', 'location_data'])
                ->where('user_id', $user_id)
                ->where('is_deleted', 0)->count();
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.Product list'),
                'data' => array("product_data" => $data, 'recordsTotal' => $recordsTotal),
            ]);
        }

        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.Product List not found'),
            'object' => array("product_data" => array()),
        ]);
    }
    public function product_list_by_saller(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_no' => 'required',
            'no_of_product' => 'required',
            'saller_id' => 'required',
        ]);
        $user = Auth::user();
        $user_id = $user->id;
        $mall_id = $request->saller_id;
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        // $start_date = $request->start_date;
        // $end_date = $request->end_date;
        // $start_date = date('Y-m-d 00:00:00', strtotime($request->start_date));
        // $end_date = date('Y-m-d 23:59:59', strtotime($request->end_date));
        $user = Auth::user();
        if ($request->no_of_product !== 0) {
            $skip = $request->page_no * $request->no_of_product;
        }

        $user_id = $user->id;
        $query = Product::query();
        // if ($request->start_date != "" && $request->end_date != "") {
        //      $query->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
        // }
        if ($request->title != "") {
            $query = $query->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->category_id != "") {
            $query->where('category_id', '=', $request->category_id);
        }

        if ($request->sub_category_id != "") {
            $query->whereHas('product_category', function ($query) use ($request) {
                $query->where('sub_category_id', '=', $request->sub_category_id);
            });
        }
        $data = $query->with(['userinfo', 'main_category', 'product_media', 'location_data'])
            ->where('user_id', $mall_id)
            ->offset($skip)->limit($request->no_of_product)
            ->where('is_deleted', 0)->get();

        if ($data->count() > 0) {
            $query = Product::query();
            if ($request->category_id != "") {
                $query->where('category_id', '=', $request->category_id);
            }
            if ($request->sub_category_id != "") {
                $query->whereHas('product_category', function ($query) use ($request) {
                    $query->where('sub_category_id', '=', $request->sub_category_id);
                });
            }
            if ($request->title != "") {
                $query = $query->where('title', 'LIKE', '%' . $request->title . '%');
            }
            if ($request->start_date != "" && $request->end_date != "") {
                $query->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
            }
            $recordsTotal = $query->with(['userinfo', 'main_category', 'product_media', 'location_data'])
                ->where('user_id', $mall_id)
                ->where('is_deleted', 0)->count();
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.Product list'),
                'data' => array("product_data" => $data, 'recordsTotal' => $recordsTotal),
            ]);
        }

        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.Product List not found'),
            'object' => array("product_data" => array()),
        ]);
    }
    public function product_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_no' => 'required',
            'no_of_product' => 'required',
        ]);
        $user = Auth::user();
        $user_id = $user->id;
        $mall_id = $request->mall_id;
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        // $start_date = $request->start_date;
        // $end_date = $request->end_date;
        // $start_date = date('Y-m-d 00:00:00', strtotime($request->start_date));
        // $end_date = date('Y-m-d 23:59:59', strtotime($request->end_date));
        $user = Auth::user();
        if ($request->no_of_product !== 0) {
            $skip = $request->page_no * $request->no_of_product;
        }

        $user_id = $user->id;
        $query = Product::query();
        // if ($request->start_date != "" && $request->end_date != "") {
        //      $query->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
        // }
        if ($request->title != "") {
             $query->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->category_id != "") {
            $query->where('category_id', '=', $request->category_id);
        }
        if ($request->sub_sub_category_id != "") {
            $query->where('sub_sub_category_id', '=', $request->sub_sub_category_id);
        }

        if ($request->sub_category_id != "") {
            $query->where('sub_category_id', '=', $request->sub_category_id);
            // $query->whereHas('product_category', function ($query) use ($request) {
            //     $query->where('sub_category_id', '=', $request->sub_category_id);
            // });
        }
        $data = $query->with(['userinfo', 'main_category', 'product_media', 'location_data'])
            ->offset($skip)->limit($request->no_of_product)
            ->where('is_deleted', 0)->get();

        if ($data->count() > 0) {
            $query = Product::query();
            if ($request->category_id != "") {
                $query->where('category_id', '=', $request->category_id);
            }
            if ($request->sub_sub_category_id != "") {
                $query->where('sub_sub_category_id', '=', $request->sub_sub_category_id);
            }
            if ($request->sub_category_id != "") {
                $query->where('sub_category_id', '=', $request->sub_category_id);
                // $query->whereHas('product_category', function ($query) use ($request) {
                //     $query->where('sub_category_id', '=', $request->sub_category_id);
                // });
            }
            if ($request->title != "") {
                $query = $query->where('title', 'LIKE', '%' . $request->title . '%');
            }
            if ($request->start_date != "" && $request->end_date != "") {
                $query->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
            }
            $recordsTotal = $query->with(['userinfo', 'main_category', 'product_media', 'location_data'])
                ->where('is_deleted', 0)->count();
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.Product list'),
                'data' => array("product_data" => $data, 'recordsTotal' => $recordsTotal),
            ]);
        }

        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.Product List not found'),
            'object' => array("product_data" => array()),
        ]);
    }

    //FOR GET MY PRODUCTS
    public function getMyProducts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_no'       => 'required',
            'no_of_product' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }

        $user    = Auth::user();
        $user_id = $user->id;

        return $this->filtterProducts($request->page_no,$request->no_of_product,$user_id,$request->title,$request->category_id,$request->sub_category_id,$request->sub_sub_category_id,$request->price,$request->product_type);
    }

    public function transit_offers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_no' => 'required',
            'no_of_product' => 'required',
        ]);
        $user = Auth::user();
        $user_id = $user->id;
        $mall_id = $request->mall_id;
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        if ($request->no_of_product !== 0) {
            $skip = $request->page_no * $request->no_of_product;
        }
        $transit_offers = User::where("user_type", 2)->offset($skip)->limit($request->no_of_product)
            ->where('is_deleted', 0)->get();
        $total_records = User::where("user_type", 2)->where('is_deleted', 0)->count();
        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.Product list'),
            'data' => array("transit_offers" => $transit_offers, "total_records" => $total_records),

        ]);
    }
    public function offers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_no' => 'required',
            'no_of_product' => 'required',
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
        $mall_id = $request->mall_id;
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        if ($request->no_of_product !== 0) {
            $skip = $request->page_no * $request->no_of_product;
        }
        $transit_offers = User::where("user_type", 2)->offset($skip)->limit($request->no_of_product)
            ->where('is_deleted', 0)->get();
        $total_records = User::where("user_type", 2)->where('is_deleted', 0)->count();
        return response()->json([
            'status' => Controller::HTTP_OK,
            'message' => trans('lang.Product list'),
            'data' => array("transit_offers" => $transit_offers, "total_records" => $total_records),
        ]);
    }
    public function delete_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $product_id = $request->product_id;
        $user = Auth::user();
        $user_id = $user->id;
        $data = Product::where('user_id', $user_id)->where('id', $product_id)->where('is_deleted', 0)->get();
        if (count($data) == 1) {
            $updateData = array("is_deleted" => 1);
            Product::where('id', $request->product_id)->update($updateData);
            $data = array();
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.Product removed successfully'),
                'data' => array("product_data" => $data),
            ]);
        } else {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.Product Data not found'),
                'object' => array("product_data" => array()),
            ]);
        }
    }

    public function edit_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'product_name' => 'required',
            'price' => 'required',
            'product_description' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'sub_sub_category_id' => 'required',
            'currency_code' => 'required',
            'country_code' => 'required',
            'location_ids' => 'required',
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
        $product_id = $request->product_id;
        $data = Product::where('user_id', $user_id)->where('id', $product_id)->where('is_deleted', 0)->get();
        if (count($data) == 1) {
            $updateData = array("product_name" => $request->product_name,
                "price" => $request->price,
                "product_description" => $request->product_description,
                "category_id" => $request->category_id,
                "sub_category_id"=>$request->sub_category_id,
                "sub_sub_category_id" => $request->sub_sub_category_id,
                "currency_code" =>$request->currency_code,
            );
            if($request->product_type == 2){
                $validator = Validator::make($request->all(), [
                    'start_time' => 'required',
                    'end_time' => 'required',
                ]);
                if ($validator->fails()) {
                    $errors = $validator->errors()->toArray();
                    return response()->json([
                        'status' => Controller::HTTP_BAD_REQUEST,
                        'message' => reset($errors)[0],
                        'object' => (object) [],
                    ]);
                }
                $updateData['start_time'] = $request->start_time;
                $updateData['end_time'] = $request->end_time;
            }
            Product::where('id', $request->product_id)->update($updateData);
            ProductLocation::where('product_id', $request->product_id)->update(["is_deleted" => '1']);
            $location_ids_array = explode(',', $request->location_ids);
            foreach ($location_ids_array as $location_id) {
                $category_data = array("product_id" => $request->product_id,
                    "location_id" => $location_id);
                ProductLocation::create($category_data);
            }
            $deletedMediaIDs_array = explode(',', $request->deleted_media_ids);
        foreach ($deletedMediaIDs_array as $media_id) {
            ProductMedia::where('id', $media_id)->update(["is_deleted" => '1']);
            $Media_data = ProductMedia::where('id', $media_id)->first();
            if (!empty($Media_data)) {
                $file_path = $Media_data->mediaUrl;
                $url = url("");
                $image_name = str_replace($url."public/uploads/media", "", $file_path);
                $destinationPath = public_path('/uploads/media/');
                File::delete($destinationPath . $image_name);
            }
        }
            if (!empty($request->file('product_medias'))) {

                foreach ($request->file('product_medias') as $image) {
                    $imgName = time() . '-' . $image->getClientOriginalName();
                    $destinationPath = public_path('/uploads/media/');
                    $image->move($destinationPath, $imgName);
                    $imageName = $imgName;
                    $addmedia["media_url"] = $imageName;
                    $addmedia["user_id"] = $user_id;
                    $addmedia["product_id"] = $request->product_id;
                    $addmedia["created_date_timestamp"] = strtotime(Carbon::now());
                    $mediaData = ProductMedia::create($addmedia);

                }
            }

            $data = Product::with(['userinfo', 'main_category', 'product_media', 'location_data'])->where('id', $request->product_id)->where('status', 1)->get();
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => array("product_data" => $data),
            ]);
        } else {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.Product Data not found'),
                'object' => array("product_data" => array()),
            ]);
        }

    }
    
    public function remove_like_list(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',

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
        $likedata = array("user_id" => $user_id,
                            "product_id" => $request->product_id);
        $UserLikeProduct =  UserLikeProduct::where('product_id', $request->product_id)->where('user_id', $user_id)->update(array('status'=>0,'is_deleted'=>1,"deleted_at"=> Carbon::now()));
        if($UserLikeProduct){
        return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => "This product removed form like list ",
                'data' => array("product_data" => ""),
            ]);
        } else {
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.Product Data not found'),
                'object' => array("product_data" => array()),
            ]);
        }
    }

}
