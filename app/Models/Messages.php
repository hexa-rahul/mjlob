<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Messages extends Model
{
    public $table = 'messages';
    public static $snakeAttributes = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','messageGroupId','unique_id','api_name','senderId','type','url','receiverId','message','isRead','staus','created_at','update_at','deleted_at'];

    protected $hidden = ['messageGroupId','unique_id','status','deleted_at','updated_at'];
    function getUrlAttribute($value=''){

      if($value == "")
          return asset('/public/uploads/messagePhotos/default.png');

      return asset('/public/uploads/messagePhotos/'.$value);
  }
     function sender_info(){

        return $this->hasone('\App\Models\User', 'id', 'senderId')->select(array('id', 'firstName','lastName','image')); 
     }
     function receiver_info(){

        return $this->hasone('\App\Models\User', 'id', 'receiverId')->select(array('id', 'firstName','lastName','image')); 
     }
     

}
