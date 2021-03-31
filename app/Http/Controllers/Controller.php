<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Models\ItemAdvertisement;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    const HTTP_BAD_REQUEST 		= 400;
    const HTTP_UNAUTHENTICATED 	= 401;
    const HTTP_OK 				= 200;

    public function permition($apiKey=''){
    	
    	if(!empty($appkey)){
          if($appkey=='#%2$#12fd$%^fg5'){

            return $next($request);
            
          }else{

            return response()->json([
                'status'  => 401,
                'message' => "Invalid Api key!",
                'object'  => (object) []
            ]);
            exit();
          }

        }else{
          
          return response()->json([
              'status'  => 401,
              'message' => "Api key is required",
              'object'  => (object) []
          ]);
          exit();
        }

    }

     //FOR GET PRODUCTS
    public function filtterProducts($page_no = '', $no_of_product=0, $user_id='', $title='', $category_id='', $sub_category_id='',$sub_sub_category_id='',$price='',$product_type='',$sort_by='', $minPrice='', $maxPrice='',$minBedroods='',$maxBedrooms='')
    {
        
        if ($no_of_product !== 0) {
            $skip = $page_no * $no_of_product;
        }

        $query     = ItemAdvertisement::query();
        if ($user_id != "") {
            $query->where('user_id', $user_id);
        }
        if ($title != "") {
             $query->where('name', 'LIKE', '%' . $title . '%');
        }

        if (($category_id != "") || ($category_id != 0)) {
            $query->where('category_id', '=', $category_id);
        }
        if (($sub_sub_category_id != "") || ($sub_sub_category_id != 0)) {
            $query->where('sub_sub_category_id', '=', $sub_sub_category_id);
        }

        if (($sub_category_id != "") || ($sub_category_id != 0)) {
            $query->where('sub_category_id', '=', $sub_category_id);
        }
        
        if ($price != "" || $price != 0) {
            $query->where('price', '<=', $price);
        }
        
        if ($product_type != "") {
            $query->where('type', $product_type);
        }
        
        if ($minBedroods != "" && $maxBedrooms != "") {
             
             $query->where('name', 'LIKE', '%' . $minBedroods . '%');
             $query->where('name', 'LIKE', '%' . $maxBedrooms . '%');
        }

        if($minPrice != '' && $maxPrice != ''){

            $query->whereBetween('price', [$minPrice, $maxPrice]);  
        }

        if ($sort_by != ""){

            //newest_to_oldest,oldest_to_newest,low_to_high_price,high_to_low_price
            if($sort_by=='newest_to_oldest'){
                
                $query->orderby('id', 'desc');
            }elseif($sort_by=='oldest_to_newest'){

                $query->orderby('id', 'asc');
            }elseif($sort_by=='low_to_high_price'){
            
                $query->orderby('price', 'asc');
            }elseif($sort_by=='high_to_low_price'){

                $query->orderby('price', 'desc');
            }
            
        }
        $data   =   $query->offset($skip)->limit($no_of_product)
                      ->get();

        if ($data->count() > 0) {
            $query = ItemAdvertisement::query();
            if (($category_id != "") || ($category_id != 0)) {
                $query->where('category_id', '=', $category_id);
            }
            if (($sub_sub_category_id != "") || ($sub_sub_category_id != 0)) {
                $query->where('sub_sub_category_id', '=', $sub_sub_category_id);
            }
            if (($sub_category_id != "") || ($sub_category_id != 0)) {
                $query->where('sub_category_id', '=', $sub_category_id);
                // $query->whereHas('product_category', function ($query) use ($request) {
                //     $query->where('sub_category_id', '=', $sub_category_id);
                // });
            }
            if ($title != "") {
                $query = $query->where('name', 'LIKE', '%' . $title . '%');
            }
            // if ($request->start_date != "" && $request->end_date != "") {
            //     $query->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
            // }

            if ($price != "" && $price != 0) {
                $query->where('price', '<=', $price);
            }
            
            if ($product_type != "") {
                $query->where('type', $product_type);
            }
            if ($minBedroods != "" && $maxBedrooms != "") {
             
                $query->where('name', 'LIKE', '%' . $minBedroods . '%');
                $query->where('name', 'LIKE', '%' . $maxBedrooms . '%');
            }

            if($minPrice != '' && $maxPrice != ''){

                $query->whereBetween('price', [$minPrice, $maxPrice]);  
            }
            if ($sort_by != ""){
                //newest_to_oldest,oldest_to_newest,low_to_high_price,high_to_low_price
                if($sort_by=='newest_to_oldest'){
                    
                    $query->orderby('id', 'desc');
                }elseif($sort_by=='oldest_to_newest'){

                    $query->orderby('id', 'asc');
                }elseif($sort_by=='low_to_high_price'){
                
                    $query->orderby('price', 'asc');
                }elseif($sort_by=='high_to_low_price'){

                    $query->orderby('price', 'desc');
                }
            }

            $recordsTotal = $query->count();
            
            // if($recordsTotal>0){
                
            //     foreach ($data as $key => $value) {
                   
            //         foreach ($value->location_data as $key_place => $value_place) {
                        
            //             $placeName = Citie::where('id',$value_place->location_id)->first(['name_en','name_ar']);
            //             $value->location_data[$key_place]->name_en = $placeName->name_en;        
            //             $value->location_data[$key_place]->name_ar = $placeName->name_ar;        
            //         } 

            //     }
            // }
            
            return response()->json([
                'status' => Controller::HTTP_OK,
                'message' => trans('lang.product_list'),
                'data' => array("product_data" => $data, 'recordsTotal' => $recordsTotal),
            ]);
        }

        return response()->json([

            'status' => Controller::HTTP_OK,
            'message' => trans('lang.product_list_not_found'),
            'object' => array("product_data" => array()),
        ]);
    }
}
