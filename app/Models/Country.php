<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Country extends Model
{
    public $table = 'country';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','countryName','countryNameAr','image','position','staus','created_at','updated_at','deleted_at'];

    function getImageAttribute($value=''){

        if($value == "")
            return asset('/public/uploads/country/default.png');

        return asset('/public/uploads/country/'.$value);
    }
    function YachtList(){

        return $this->hasmany('\App\Models\YachtList', 'countryId', 'id'); 
     }



}
