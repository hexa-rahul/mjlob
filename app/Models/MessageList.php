<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class MessageList extends Model
{
    public $table = 'message_lists';
    public static $snakeAttributes = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','groupId','senderId','receiverId','message','staus','created_at','update_at','deleted_at'];

     function sender_info(){

        return $this->hasone('\App\Models\User', 'id', 'senderId')->select(array('id', 'firstName','lastName','image')); 
     }
     function receiver_info(){

        return $this->hasone('\App\Models\User', 'id', 'receiverId')->select(array('id', 'firstName','lastName','image')); 
     }
     

}
