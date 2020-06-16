<?php

	namespace App\Controllers;

	use App\Models\Post as Post;
	use App\Controllers\Controller;
	use Respect\Validation\Validator as v;
	use App\Models\Comment;
	
	class CommentsController extends Controller
	{
		public function index($request, $response)
		{
			$postId= $request->getAttribute('postid');

			$comments = null;
			$code = 400;
			if ($postId != null) {
				$post = Post::find($postId);
				if ($post != null) {
					$comments = $post->comments()->get();
					$code = 200;
				}
			}
			
			return $response->withJson($comments, $code);
		}
	
		public function store($request, $response)
		{
			$validation = $this->validator->validate($request, [
				'content' => v::notEmpty(),
			]);

			$data = new \stdClass;

			if($validation->failed()) {
				return $response->withJson($data, 400);
			}
			
			$postId = $request->getParam('post_id');
			$content = $request->getParam('content');

			$comment = new Comment([
				'content' => $content,
				'post_id' => $postId,
				'user_id' => '15'
			]);
		
			$post = Post::find($postId);
			
			if ($post != null) {
				$comment->save();
				$code = 204;
			} else {
				$code = 500;
			}

			return $response->withJson($data, $code);
		}
	}

?>
