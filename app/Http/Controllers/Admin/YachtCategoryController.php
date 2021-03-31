<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\YachtCategory;
use Validator;
use Hash;
use Carbon\Carbon;

class YachtCategoryController extends Controller
{
    public function index()
    {
    	$data   = YachtCategory::where('deleted_at', NULL)->get();
    	$title  = trans('lang.YachtCategoryList');
        return view('admin/YachtCategory/index', compact('data', 'title'));
    }

    public function createView()
    {
    	$title  = trans('lang.AddYachtCategory');
        return view('admin/YachtCategory/add', compact('title'));
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

            'categoryName'                     => 'required',
            'categoryNameAr'                     => 'required',
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
            $destinationPath = public_path('/uploads/YachtCategory/');
            $image->move($destinationPath, $imgName);
            $inputRequest['image']  = $imgName;
        }
        $ceartedata  =   YachtCategory::create($inputRequest);
        return redirect('admin/yacht-category-list')->with('status', 'Yacht Category Added successfully');
    }

    public function _delete($id)
    {

        $data             = YachtCategory::where('id',decrypt($id))->first();
        $data->deleted_at = Carbon::now();
        $data->status = 0;
        $data->save();

        return redirect()->back()->with('status', "Yacht Category delete successfully");
    }

    public function editView($id){

        $request_id = decrypt($id);
        $data       = YachtCategory::where('deleted_at', NULL)
                         ->where('id', $request_id)
                         ->where('status', 1)
                         ->first();

        $title      = trans('lang.EditYachtCategory');

        return view('admin/YachtCategory/edit', compact('data', 'title'));
    }

    public function _edit(Request $request){


        $validator = Validator::make($request->all(), [

            'categoryName'               => 'required',
            'categoryNameAr'               => 'required',
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
        $categoryName        = $request->categoryName;
        $categoryNameAr        = $request->categoryNameAr;
        $updatData = array("categoryName" => $categoryName,"categoryNameAr"=>$categoryNameAr);
        if(!empty($request->file('image'))){

            $image           = $request->file('image');
            $imgName         = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/YachtCategory/');
            $image->move($destinationPath, $imgName);
            $updatData["image"] = $imgName;
        }
        $ceartedata          =   YachtCategory::where('id', $country_id)
                                    ->update($updatData);

        return redirect('admin/yacht-category-list')->with('status', "Yacht Category update successfully");

    }
}
