<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class SiteSetting extends Model
{
    public $table = 'site_setting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','trems','PrivacyPolicy','aboutUs','contactUs','created_at','update_at','deleted_at'];



}
