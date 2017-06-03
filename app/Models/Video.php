<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
    * Get all of the Video's likes.
    */
    public function likes()
    {
        return $this->morphMany('App\Likes', 'likeable');
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