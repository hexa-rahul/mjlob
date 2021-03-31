<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Group extends Model
{
    public $table = 'groups';
    public static $snakeAttributes = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','names','staus','created_at','update_at','deleted_at'];

   
   
     function user_data(){

        return $this->hasMany('\App\Models\UserGroups', 'groupId', 'id')->select(array('id', 'firstName','lastName','image')); 
     }
     

}
