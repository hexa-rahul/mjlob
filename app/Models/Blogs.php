<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Blogs extends Model
{
    public $table = 'blogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','title','image','dicsrption','userId','status','created_at','update_at','deleted_at'];

     function getImageAttribute($value=''){

        if($value == "")
            return asset('/public/uploads/user-profile/default.png');

        return asset('/public/uploads/flag/'.$value);
    }

    function userinfo(){

        return $this->hasMany('\App\Models\user', 'id', 'userId');
     }
}
