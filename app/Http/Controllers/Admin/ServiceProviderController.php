<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\YachtList;
use Illuminate\Http\Request;
use View;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ServiceProviderController extends Controller
{

    public function service_provider_list(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('status', 1)->where('user_type', 'Owner')
                ->get();
                $con = "Are you sure you want to remove this data?";
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)  use($con){
                    $btn = '<a title="View" href="' . url('/admin/service-provider-profile') . '/' . encrypt($row->id) . '" class="btn btn-info btn btn-sm"><i class="fa  fa-eye" aria-hidden="true"></i></a>
                    <a  class="btn btn-danger btn btn-sm" title="Delete" href="' . url('/admin/service-provider/delete'). '/' . encrypt($row->id) . '" onclick="return confirm(\'' . $con . '\');" >
                                                           <i class="fa  fa-trash-o" aria-hidden="true"></i>
                                                        </a>';
                                                         return $btn;
                })
                ->addColumn('profile_pic', function ($row) {
                    $btn = '<img width="50" height="50" src=' . $row->image . '>';
                    return $btn;
                })
                ->rawColumns(['action', 'profile_pic'])
                ->make(true);
        }
        $title = trans('lang.user_list');
        return view('admin/ServiceProvider/ServiceProvider_list')->with(compact(['title']));
    }
    // FOR USER PROFILE
    public function service_provider_view(Request $request, $id)
    {
        $data = User::where('id', decrypt($id))->first();
        if ($request->ajax()) {
            $data = YachtList::with(['accommodationData', 'featuresData', 'crewData', 'yachtPhotos', 'categoryData', 'countryData'])
                ->whereHas('accommodationData', function ($query) {
                    $query->where('yacht_accommodation_data.status', '=', '1');
                })->whereHas('featuresData', function ($query) {
                $query->where('yacht_features_data.status', '=', '1');
            })->whereHas('crewData', function ($query) {
                $query->where('yacht_crew_data.status', '=', '1');
            })->whereHas('yachtPhotos', function ($query) {
                $query->where('yacht_photos.status', '=', '1');
            })->whereHas('categoryData', function ($query) {
                $query->where('yacht_category.status', '=', '1');
            })->whereHas('countryData', function ($query) {
                $query->where('country.status', '=', '1');
            })->where('status', 1)->where('user_id', decrypt($id))
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a title="View" href="' . url('/admin/yacht-details') . '/' . encrypt($row->id) . '" class="btn btn-info btn btn-sm"><i class="fa  fa-eye" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = trans('lang.Serviceproviderprofile');
        $yacht_list_title = trans('lang.yacht_list');;
        return view('admin/ServiceProvider/profile')->with(compact(['title', 'data', 'yacht_list_title']));
    }
    public function yacht_details(Request $request, $id)
    {
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
            }])->where('id', decrypt($id))
            ->where('status', 1)
            ->first();
        $title = trans('lang.Yachtdetails');
        return view('admin/ServiceProvider/yacht_details')->with(compact(['title', 'data']));
    }
    public function user_delete($id)
    {
        $data = User::where('id',decrypt($id))->first();
        $data->deleted_at = Carbon::now();
        $data->status = 0;
        $data->save();
        return redirect()->back()->with('status', trans('lang.delete_user_success'));
    }

}
