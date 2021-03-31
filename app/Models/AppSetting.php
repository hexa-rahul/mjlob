<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class AppSetting extends Model
{
    //public $table = 'app_settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','ios_version','android_version','ios_version_force_update','android_version_force_update','category_version','created_at','update_at','deleted_at'];

}