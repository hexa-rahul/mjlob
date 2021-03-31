<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MasterCategory;
use Hash;
use Session;
use App;
use Config;


class HomeController extends Controller
{
    //
    public function index()
    {

      $TOTAL_USER             = User::count();
      $total_category         = MasterCategory::where('deleted_at', null)->count();;
      $currenBooking          = 20;
      $allBooking             = 30;
      return view('admin/homepage', compact('TOTAL_USER','total_category','currenBooking','allBooking'));
      
    }

    public function EnglishLanguage(Request $request){
      $request = request();
      Session::put('lan', "en");
      Session::save();
      return\Redirect::back();

  }

  public function ArabicLanguage(Request $request){
      $request = request();
      Session::put('lan', "uae");
      Session::save();
       return\Redirect::back();
       return redirect('admin/admin_dashboard');

  }
}
