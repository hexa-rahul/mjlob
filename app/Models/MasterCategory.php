<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class MasterCategory extends Model
{
    //public $table = 'mj_master_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [ 'parent_id','name','name_ar','description','description_ar','image','type','is_sub_category_exist','updated_at'];

    
    function subData(){

        return $this->hasmany('\App\Models\MasterCategory', 'parent_id', 'id'); 
     }

}
