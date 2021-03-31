<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class YachtPhotos extends Model
{
    public $table = 'yacht_photos';
    public static $snakeAttributes = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','yachtId','yachtPhoto','userId','staus','created_at','update_at','deleted_at'];

    function getYachtPhotoAttribute($value=''){

        if($value == "")
        
            return asset('/public/uploads/yachtphotos/default.png'); 
            
            return asset('/public/uploads/yachtphotos/'.$value);
    }
    

}
