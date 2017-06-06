<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{   
    protected $fillable = [
        'user_id',
        'likable_id',
        'likable_type',
        'value'
    ];
    /**
     * Get all of the owning Likeable models.
     */
    public function likeable()
    {
        return $this->morphTo();
    }
    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = [
        'created_at',
        'updated_at'
    ];
}

?>