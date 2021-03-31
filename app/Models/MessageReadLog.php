<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class MessageReadLog extends Model
{
    public $table = 'message_read_log';
    public static $snakeAttributes = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','messageId','userId','status','isRead','created_at','update_at','deleted_at'];

   //   function message_info(){

   //      return $this->hasone('\App\Models\User', 'id', 'messageId')->select(array('id', 'firstName','lastName','image')); 
   //   }
     

}
