<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{   
    protected $table = 'comments';
    protected $fillable = [
    		'content',
    		'user_id',
    		'post_id'
    ];
    public function user()
    {
    	return $this->hasOne('App\Models\User');
    }

    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    /**
     * Get all of the comment's likes.
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
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