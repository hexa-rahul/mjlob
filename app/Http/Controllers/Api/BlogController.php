<?php

namespace App\Http\Controllers\Api;

use App;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class BlogController extends Controller
{
    //
    public function addblog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobileNo' => 'required',
        ]);
        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            return response()->json([
                'status' => Controller::HTTP_BAD_REQUEST,
                'message' => reset($errors)[0],
                'object' => (object) [],
            ]);
        }
        $input = $request->all();
        $user = Auth::user();
        $user_id = $user->id;
        $addblog = array("userId" => $user_id, "title" => $request->title, "dicsrption" => $request->dicsrption);
        if (!empty($request->file('image'))) {

            $image = $request->file('image');
            $imgName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/blog/');
            $image->move($destinationPath, $imgName);

            $imageName = $imgName;
            $addblog["image"] = $imageName;

        }
        $blogData = Blog::create($addblog);
        if ($blogData) {
            $data = Blog::with(['userinfo'])->where('id', $blogData->id)->where('status', 1)->get();
            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => "",
                'data' => $data,

            ]);
        } else {

            return response()->json([

                'status' => Controller::HTTP_OK,
                'message' => trans('lang.please_try_again'),
                'object' => (object) [],

            ]);
        }

    }

}
