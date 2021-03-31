<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class UserPlan extends Model
{
    public $table = 'user_plan';
    public static $snakeAttributes = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','user_id','plan_id','transaction_id','is_active_plan','plan_expire_date','staus','created_at','update_at','deleted_at'];

     function sender_info(){

        return $this->hasone('\App\Models\User', 'id', 'senderId')->select(array('id', 'firstName','lastName','image')); 
     }
     function receiver_info(){

        return $this->hasone('\App\Models\User', 'id', 'receiverId')->select(array('id', 'firstName','lastName','image')); 
     }
     

}
