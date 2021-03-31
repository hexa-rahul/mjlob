<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class YachtFavorite extends Model
{
    public $table = 'yacht_favorite_list';
    public static $snakeAttributes = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','yachtId','isfavorite','userId','staus','created_at','update_at','deleted_at'];

    function getYachtPhotoAttribute($value=''){

        if($value == "")
        
            return asset('/public/uploads/yachtphotos/default.png'); 
            
            return asset('/public/uploads/yachtphotos/'.$value);
    }
    function Yachtdata(){

        return $this->hasone('\App\Models\YachtList', 'id', 'yachtId'); 
     }
     function yachtPhotos(){

        return $this->hasMany('\App\Models\YachtPhotos', 'yachtId', 'yachtId')->select(array('id', 'userId','yachtId','yachtPhoto')); 
     }
     

}
