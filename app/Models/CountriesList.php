<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class CountriesList extends Model
{
    public $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','country','code','phone_code','flag','country_icon','created_at','update_at','deleted_at'];

     function getCountryIconAttribute($value=''){

        if($value == "")
            return asset('/public/uploads/user-profile/default.png');

        return asset('/public/uploads/flag/'.$value);
    }


}
