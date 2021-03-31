<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Notification extends Model
{
    //public $table = 'messages';
    public static $snakeAttributes = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','sender_id','reciver_id','message','sender_type','read_status','created_at','update_at','deleted_at'];

    function userDetail(){

        return $this->belongsTo('\App\Models\User', 'sender_id', 'id');
     }
}