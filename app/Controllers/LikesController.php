<?php

	namespace App\Controllers;

	use App\Models\Post as Post;
	use App\Controllers\Controller;
	use Respect\Validation\Validator as v;
	use App\Models\Like;
	use App\Models\Comment;
	
	class LikesController extends Controller
	{
		public function index($request, $response)
		{	
			$validation = $this->validator->validate($request, [
				'likable_id' => v::notEmpty(),
				'likable_type' => v::notEmpty(),
			]);
			$data = new \stdClass;

			if($validation->failed()) {
				return $response->withJson($data, 400);
			}
			$likableId= $request->getParam('likable_id');
			$likableType = $request->getParam('likable_type');

			$likes = null;
			$code = 400;
			$likable = $likableType == 'post' ? Post::find($likableId) :  Comment::find($likableId);
			if ($likable != null) {
					$likes = $post->likes()->get();
					$code = 200;
			}
			
			return $response->withJson($likes, $code);
		}
	
		public function store($request, $response)
		{
			$validation = $this->validator->validate($request, [
				'likable_id' => v::notEmpty(),
				'likable_type' => v::notEmpty(),
				'value' => v::notEmpty(),
			]);

			$data = new \stdClass;

			if($validation->failed()) {
				return $response->withJson($data, 400);
			}
			
			$likableId = $request->getParam('likable_id');
			$likableType = $request->getParam('likable_type');
			$value = $request->getParam('value');

			$like = new Like([
				'user_id' => 15,
				'likable_id' => $likableId,
				'likable_type' => $likableType,
				'value' => $value,
			]);
		
			$likable = $likableType == 'post' ? Post::find($likableId) :  Comment::find($likableId);
			
			if ($likable != null) {
				$like->save();
				$code = 204;
			} else {
				$code = 500;
			}

			return $response->withJson($data, $code);
		}
	}

?>
