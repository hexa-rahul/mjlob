<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class YachtCategory extends Model
{
    public $table = 'yacht_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','categoryName','categoryNameAr','image','status','created_at','updated_at','deleted_at'];

    function getImageAttribute($value=''){

        if($value == "")
            return asset('/public/uploads/user-profile/default.png');

        return asset('/public/uploads/YachtCategory/'.$value);
    }


}
