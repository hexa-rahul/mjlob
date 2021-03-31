<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class YachtList extends Model
{
    public $table = 'yachtlist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','user_id','passengers','yachtPrice','meter','cabins','crews','countryId','categoryId','address','city','country','longitude','latitude','yachtName','generalInfoLength','generalInfoBeam','generalInfoDraft','generalInfoGrossTonnage','builder','yearOfBuild','maxspeed','cruisingSpeed','fuelConsumption','gasoilTank','EngineManufacturer','EngineModel','EngineType','EngineTotalpower','EngineQuantity','status','created_at','update_at','deleted_at'];

    function getYachtPriceAttribute($value=''){

      if($value == "")
      
          return '0'; 
          
          return "$value";
  }
    function user_detail(){

        return $this->hasOne('\App\Models\User', 'id', 'user_id')->select(array('id','firstName','lastName','image'));  
     }
	 function member_detail(){

        return $this->hasMany('\App\Models\User', 'id', 'member_id'); 
     }
    function accommodationData(){

        return $this->hasMany('\App\Models\YachtAccommodationData', 'yachId', 'id')->select(array('id', 'userId','yachId','accomodationName','amount')); 
     }
    function featuresData(){

        return $this->hasMany('\App\Models\YachtFeaturesData', 'yachId', 'id')->select(array('id', 'userId','yachId','featuresName')); 
     }
    function crewData(){

        return $this->hasMany('\App\Models\YachtCrewData', 'yachId', 'id')->select(array('id', 'userId','yachId','crewName','crewType'));
     }
     function yachtPhotos(){

        return $this->hasMany('\App\Models\YachtPhotos', 'yachtId', 'id')->select(array('id', 'userId','yachtId','yachtPhoto')); 
     }
     function categoryData(){

        return $this->hasone('\App\Models\YachtCategory', 'id', 'categoryId')->select(array('id', 'categoryName'));; 
     }
     function countryData(){

        return $this->hasone('\App\Models\Country', 'id', 'countryId')->select(array('id', 'countryName','image'));; 
     }


}
