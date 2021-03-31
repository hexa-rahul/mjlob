<?php

namespace App\Http\Controllers;
use App\Models\MasterCategory;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth')->except('about_us');;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //echo "--------"; die;
        return $category     = MasterCategory::orderBy('id', 'desc')->where("is_deleted",0 )->get();
        //return view('home');
    }
    public function about_us(){
        $data = SiteSetting::select("aboutUs")->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();
            
		
		return view('website/about-us')->with(compact(['data', 'title']));
	   }
    public function privacy(){
        $data = SiteSetting::select("PrivacyPolicy")->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();
            
		
		return view('website/privacy')->with(compact(['data', 'title']));
	   }
    public function terms(){
        $data = SiteSetting::select("trems")->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();
            
		
		return view('website/terms')->with(compact(['data', 'title']));
	   }
}
