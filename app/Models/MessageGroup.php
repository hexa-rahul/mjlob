<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class MessageGroup extends Model
{
    public $table = 'message_group';
    public static $snakeAttributes = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','senderId','receiver_id','staus','created_at','update_at','deleted_at'];

   
   
   //   function user_data(){

   //      return $this->hasMany('\App\Models\UserGroups', 'groupId', 'id')->select(array('id', 'firstName','lastName','image')); 
   //   }
   function last_messsage(){

           return $this->hasOne('\App\Models\Messages', 'messageGroupId', 'id')->select(array('id', 'message','messageGroupId','type','created_at'))->latest(); 
        }

        function sender_info(){

                return $this->hasone('\App\Models\User', 'id', 'senderId')->select(array('id', 'full_name','image')); 
             }
             function receiver_info(){
        
                return $this->hasone('\App\Models\User', 'id', 'receiver_id')->select(array('id', 'full_name','image')); 
             }
     

}
