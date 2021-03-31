<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MasterCategory;
use Validator;
use Hash;
use Carbon\Carbon;

class MasterCategoryController extends Controller
{
    public function index()
    {
    	$data    = MasterCategory::where('parent_id', 0)->where('deleted_at', NULL)->get();
    	$title   = trans('lang.master_category_list');
        $masterCategory = '';
        return view('admin/MasterCategory/index', compact('data', 'title', 'masterCategory'));
    }

    public function getSubcategory(Request $request, $id)
    {
        $id      = decrypt($id);
        $masterCategory    = MasterCategory::where('id', $id)->where('deleted_at', NULL)->first(['name']);
        $masterCategory    = $masterCategory->name;
        $data    = MasterCategory::where('parent_id', $id)->where('deleted_at', NULL)->get();
        $title   = trans('lang.master_category_list');
        return view('admin/MasterCategory/index', compact('data', 'title', 'masterCategory'));
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
        $data       = MasterCategory::where('deleted_at', NULL)
                         ->where('id', $request_id)
                         ->first();

        $title      = trans('lang.edit_category');

        return view('admin/MasterCategory/edit', compact('data', 'title'));
    }

    public function _edit(Request $request){


        $validator = Validator::make($request->all(), [

            'name'               => 'required',
            'name_ar'               => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status'    => Controller::HTTP_BAD_REQUEST,
                'message'   => reset($errors)[0],
                'object'    => (object) []
            ]);
        }

        $id        = base64_decode($request->encryption_id);
        $name        = $request->name;
        $name_ar        = $request->name_ar;
        $updatData = array("name" => $name,"name_ar"=>$name_ar);
        if(!empty($request->file('image'))){

            $image           = $request->file('image');
            $imgName         = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/YachtCategory/');
            $image->move($destinationPath, $imgName);
            $updatData["image"] = $imgName;
        }
       
        $ceartedata          =   MasterCategory::where('id', $id)
                                    ->update($updatData);
        
        $getParent           =   MasterCategory::where('id', $id)->first();
        if($getParent->parent_id=='0'){

            return redirect('admin/category-list')->with('status', "Category update successfully");
        }else{
            return redirect('admin/category-list/'.encrypt($getParent->parent_id))->with('status', "Category update successfully");
        }
        // return redirect('admin/category-list')->with('status', "Category update successfully");
        return redirect()->back()->with('status', "Category update successfully");                                    

    }
}
