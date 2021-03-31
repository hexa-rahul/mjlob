<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use Validator;
use Hash;
use Carbon\Carbon;

class CountryController extends Controller
{
    public function index()
    {
    	$data   = Country::where('deleted_at', NULL)->get();
    	$title  = trans('lang.Country_List');
        return view('admin/country/index', compact('data', 'title'));
    }

    public function createView()
    {
    	$title  = trans('lang.AddCountry');
        return view('admin/country/add', compact('title'));
    }

    public function RandomString($length) {

        $key  = '';
        $keys = array_merge(range('a', 'z'), range('1', '9'));
        for($i=0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }
    public function create(Request $request){


        $validator = Validator::make($request->all(), [

            'countryName'                     => 'required',
            'countryNameAr'             => 'required',
            'image'                     => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status'    => Controller::HTTP_BAD_REQUEST,
                'message'   => reset($errors)[0],
                'object'    => (object) []
            ]);
        }

        $inputRequest        = $request->all();

        if(!empty($request->file('image'))){

            $image           = $request->file('image');
            $imgName         = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/country/');
            $image->move($destinationPath, $imgName);
            $inputRequest['image']  = $imgName;
        }
        $ceartedata  =   Country::create($inputRequest);
        return redirect('admin/country-list')->with('status', 'Add Country successfully');
    }

    public function _detail(Request $request, $id){

        $request_id = decrypt($id);
        $data       = Country::where('deleted_at', NULL)
                         ->where('id', $request_id)
			             ->first();

        $title  = "country Detail";
        return view('admin/country/detail', compact('data', 'title'));
    }

    public function _delete($id)
    {

        $data             = Country::where('id',decrypt($id))->first();
        $data->deleted_at = Carbon::now();
        $data->status = 0;
        $data->save();

        return redirect()->back()->with('status', "Country delete successfully");
    }

    public function editView($id){

        $request_id = decrypt($id);
        $data       = Country::where('deleted_at', NULL)
                         ->where('id', $request_id)
                         ->first();

        $title      = trans('lang.EditCountry');

        return view('admin/country/edit', compact('data', 'title'));
    }

    public function _edit(Request $request){


        $validator = Validator::make($request->all(), [

            'countryName'               => 'required',
            'countryNameAr'             => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status'    => Controller::HTTP_BAD_REQUEST,
                'message'   => reset($errors)[0],
                'object'    => (object) []
            ]);
        }

        $country_id   = base64_decode($request->encryption_id);
        $countryName        = $request->countryName;
        $position        = $request->position;
        $countryNameAr        = $request->countryNameAr;
        $updatData = array("countryName" => $countryName,
                            "position" => $position,
                            "countryNameAr" => $countryNameAr );
        if(!empty($request->file('image'))){

            $image           = $request->file('image');
            $imgName         = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/country/');
            $image->move($destinationPath, $imgName);
            $updatData["image"] = $imgName;
        }
      
        $ceartedata          =   Country::where('id', $country_id)
                                    ->update($updatData);

        return redirect('admin/country-list')->with('status', "Country update successfully");

    }
}
