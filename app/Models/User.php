<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;
	use App\Models\Post;

	class User extends Model
	{
		protected $table = 'users';
		protected $fillable = [
			'email',
			'name',
			'password',
		];

		public function setPassword($password)
		{
			$this->update([
				'password' => password_hash($password, PASSWORD_DEFAULT)
			]);
		}

		/**
		* Get the comments for the blog post.
		*/
		public function posts()
		{
			return $this->hasMany('App\Models\Post');
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