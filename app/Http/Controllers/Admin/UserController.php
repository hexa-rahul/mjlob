<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Auth;
use Hash;
use View;
use DB;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{

    public function user_list(Request $request)
    {
        if ($request->ajax()) {
            $onerror  = "onerror=\"this.src='".url('/public/uploads/user-profile/default.png')."'\"";
            $data     = User::where('deleted_at', null)->get();
            $con      = "Are you sure you want to remove this data?";
            $active   = "Are you sure you want to change this user status?";

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use($con,$active) {
                    $btn = '<a title="View" href="' . url('/admin/user-profile') . '/' . encrypt($row->id) . '" class="btn btn-info btn btn-sm"><i class="fa  fa-eye" aria-hidden="true"></i></a>
                            <a  class="btn btn-danger btn btn-sm" title="Delete" href="' . url('/admin/user/delete'). '/' . encrypt($row->id) . '" onclick="return confirm(\'' . $con . '\');" >
                                <i class="fa  fa-trash-o" aria-hidden="true"></i>
                            </a>
                            ';
                        if($row->is_active==1){

                            $altd = 'Are you sure you want to deactive this user?';
                            $btn.='<a  class="btn btn-danger btn btn-sm" title="Active/Deactive" href="' . url('/admin/user/status'). '/' . encrypt($row->id) . '" onclick="return confirm(\'' . $altd . '\');" >Deactive</a>'; 

                        }else if($row->is_active==0){

                            $alta = 'Are you sure you want to Active this user?';
                            $btn.='<a  class="btn btn-success btn btn-sm" title="Active/Deactive" href="' . url('/admin/user/status'). '/' . encrypt($row->id) . '" onclick="return confirm(\'' . $alta . '\');" >Active</a>'; 
                        }

                      return $btn;
                })
                ->addColumn('image', function ($row) use($onerror) {
                    $btn = "<img width='50' ". $onerror." height='50' src=" . $row->image . ">";
                    return $btn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        $title          = trans('lang.user_list');
        return view('admin/user/user_list')->with(compact(['title']));
    }

    public function user_change_status(Request $request,$id)
    {
        $id        = decrypt($id);
        $user_data = User::where('id',$id)->first();

        if($user_data->is_active == 1){

            $user_data->is_active = 0;
        }else{

            $user_data->is_active = 1;
        }

        $user_data->save();
        // $data     = array('isActive' => $user_data->is_active, 'user_id' => $id );
        // return json_encode($data);
        return redirect()->back()->with('status', 'Status change successfully');
    }

    public function user_delete($id)
    {
        $data = User::where('id',decrypt($id))->first();
        $data->deleted_at = Carbon::now();
        $data->is_verified_seller = 0;
        $data->save();
        return redirect()->back()->with('status', trans('lang.delete_user_success'));
    }

    public function view_edit($id)
    {
        $data   = User::where('id',decrypt($id))->first();
        $title  = trans('lang.edit_user');;
        return view('admin/user/edit')->with(compact(['data', 'title']));

    }

    public function edit(Request $req)
    {
        $data               = User::find($req->id);
        $data->fname        = $req->fname;
        $data->lname        = $req->lname;

        if($data->save()){

            return redirect()->back()->with('status',"About Us Update successfully");
        }else{
            return redirect()->back()->with('status_err',"About Us not Update successfully");

        }

    }

    // FOR USER PROFILE
    public function user_view($id)
    {
        $data = User::where('id',decrypt($id))->first();
        return view('admin/user/profile')->with(compact(['data']));
    }
}
