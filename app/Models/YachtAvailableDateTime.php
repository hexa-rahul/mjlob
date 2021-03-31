<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class YachtAvailableDateTime extends Model
{
    public $table = 'yacht_available_date_time';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','yachtId','AvailableDateId','userId','date','startTime','endTime','status','created_at','updated_at','deleted_at'];




}
