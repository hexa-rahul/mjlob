<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class YachtCrewData extends Model
{
    public $table = 'yacht_crew_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','userId','yachId','crewName','crewType','status','created_at','update_at','deleted_at'];

     


}
