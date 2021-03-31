<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class UserGroup extends Model
{
    public $table = 'user_groups';
    public static $snakeAttributes = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','userId','groupId','staus','created_at','update_at','deleted_at'];

    function user_data(){

        return $this->hasone('\App\Models\User', 'id', 'userId')->select(array('id', 'firstName','lastName','image')); 
     }

    
     

}
