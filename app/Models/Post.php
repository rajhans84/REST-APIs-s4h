<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Post extends Model
	{
		protected $table = 'posts';
		protected $fillable = [
				'user_id',
				'content'
		];

		/**
		* Get the comments for the blog post.
		*/
		public function comments()
		{
			return $this->hasMany('App\Models\Comment');
		}
	
		/**
		* Get all of the post's likes.
		*/
		public function likes()
		{
			return $this->morphMany('App\Models\Likes', 'likeable');
		}

		public function setPassword($password)
		{
			$this->update([
				'password' => password_hash($password, PASSWORD_DEFAULT)
			]);
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