<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens,Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'full_name','fname','lname','username','image','country_code','mobile_number','otp','location','google_map_link','latitude','longitude','password','avag_rating', 'is_verified_seller','device_type','device_token','resource','social_id','social_type','register_type','is_accepted_terms_condition'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'fname','lname','password', 'remember_token','otp','updated_at','deleted_at','device_type','device_token','login_type','social_id','social_type','resource','register_type','google_map_link'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function getImageAttribute($value=''){

        if($value == "")
            return asset('/public/uploads/user-profile/default.png');

        return asset('/public/uploads/user-profile/'.$value);
    }
    
    function active_plan(){

        return $this->hasOne('\App\Models\UserPlan', 'user_id', 'id')->latest(); 
     }
     
}
