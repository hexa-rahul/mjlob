<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class YachtAvailableDate extends Model
{
    public $table = 'yacht_available_date';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'id','yachtId','userId','date','status','created_at','updated_at','deleted_at'];

    function YachtList(){

        return $this->hasone('\App\Models\YachtList', 'id', 'yachtId'); 
     }
    function AvailableDateTime(){

        return $this->hasmany('\App\Models\YachtAvailableDateTime', 'AvailableDateId', 'id')->where('status','=', 1); 
     }




}
