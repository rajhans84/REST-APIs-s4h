<?php

	namespace App\Controllers;

	use App\Models\Post as Post;
	use App\Models\User as User;
	use App\Controllers\Controller;
	use Respect\Validation\Validator as v;

	class PostsController extends Controller
	{
		public function index($request, $response)
		{
			$id = $request->getAttribute('id');
			$posts = $id == null ? Post::all(): Post::find($id);
			return $response->withJson($posts, 200);
		}
		
// 		public function comments($request, $response)
// 		{
// 			$postid= $request->getAttribute('postid');
// 			$posts = $postid== null ? Comment::post(): Post::find($postid);
// 			return $response->withJson($posts, 200);
// 		}

		public function store($request, $response)
		{
			$validation = $this->validator->validate($request, [
				'content' => v::notEmpty(),
			]);

			$data = new \stdClass;

			if($validation->failed()) {
				return $response->withJson($data, 400);
			}

			$post = new Post([
				'content' => $request->getParam('content'),
			]);
		
			$user = User::find(15);

			$user->posts()->save($post);

			return $response->withJson($data, 204);
		}
	}

?>
