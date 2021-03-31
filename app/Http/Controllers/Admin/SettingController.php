<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SiteSetting;
use App\Models\ContactUs;
use App\Services\ExistingClass;
use Session;
use Carbon\Carbon;
use Validator;



class SettingController extends Controller
{
    //

    public function __construct($foo = null)
    {
        $this->driver = new ExistingClass();
    }

    public function trems(Request $request)
    {
        $data = SiteSetting::select("trems")->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();

        $title = trans('lang.Terms_and_Conditions');
        return view('admin/trems')->with(compact(['data', 'title']));
    }
    public function updateTrems(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'trems' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/trems')
                        ->withErrors($validator,'trems')
                        ->withInput();
        }
        $updateData = SiteSetting::where('id', 1)->update(['trems' => $request->trems]);
        $title = trans('lang.Terms_and_Conditions');
        $data = SiteSetting::select("trems")->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();
        return view('admin/trems')->with(compact(['data', 'title']));
    }
    public function PrivacyPolicy(Request $request)
    {
        $data = SiteSetting::select("PrivacyPolicy")->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();

        $title =  trans('lang.Privacy_Policy');
        return view('admin/PrivacyPolicy')->with(compact(['data', 'title']));
    }
    public function updatePrivacyPolicy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'PrivacyPolicy' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/privacy-policy')
                        ->withErrors($validator,'PrivacyPolicy')
                        ->withInput();
        }
        $updateData = SiteSetting::where('id', 1)->update(['PrivacyPolicy' => $request->PrivacyPolicy]);
        return redirect('admin/privacy-policy');
    }
    public function aboutUs(Request $request)
    {
        $data = SiteSetting::select("aboutUs")->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();

        $title =  trans('lang.About_US');
        return view('admin/AboutUS')->with(compact(['data', 'title']));
    }
    public function updateAboutUs(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'aboutUs' => 'required',
        ]);
        if ($validator->fails()) {
            
            return redirect('admin/about-us')
                        ->withErrors($validator,'trems')
                        ->withInput();
        }

        $updateData = SiteSetting::where('id', 1)->update(['aboutUs' => $request->aboutUs]);
        return redirect('admin/about-us');

    }
    public function Contactus(Request $request)
    {
        $data = ContactUs::where('deleted_at', null)
            ->orderBy('id', 'desc')
            ->get();

        $title = trans('lang.ContactUS');
        return view('admin/ContactUSList')->with(compact(['data', 'title']));
    }

    public function viewContactUs($id)
    {
        $data    = ContactUs::where('id',decrypt($id))->first();
        $title   = trans('lang.view_contact_us');
        return view('admin/view_contact_us')->with(compact(['data', 'title']));

    }


    public function delete_contactus($id)
    {
        $data              = ContactUs::where('id',decrypt($id))->first();
        $data->deleted_at  = Carbon::now();
        $data->save();
        return redirect()->back()->with('status', trans('lang.delete_success'));
    }

    public function updateContactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contactUs' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/contact-us')
                        ->withErrors($validator,'contactUs')
                        ->withInput();
        }
        
        $updateData = SiteSetting::where('id', 1)->update(['contactUs' => $request->contactUs]);
        return redirect('admin/contact-us');
    }
}
