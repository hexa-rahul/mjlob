<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
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
        if($user){
			return response()->json([

                'status'    => Controller::HTTP_OK,
                'message'   =>  "user details",
                'object'    => $user
            ]);
		}else{

			return response()->json([
                'status'    => Controller::HTTP_BAD_REQUEST,
                'message'   => "User not found",
                'object'    => (object) []
            ]);
		}
    }

}
