<?php
	
	use App\Middleware\AuthMiddleware;
	use App\Middleware\GuestMiddleware;

	$app->get('/', 'HomeController:index')->setName('home');
	// TODO: Add authentication mechanism for API 
	$app->get('/posts', 'PostsController:index');
	$app->get('/posts/{id}', 'PostsController:index');
	$app->post('/posts', 'PostsController:store');
	
	$app->post('/comments', 'CommentsController:store');
	$app->get('/comments/{postid}', 'CommentsController:index');
	$app->post('/likes', 'LikesController:store');
	$app->get('/likes/{likeid}', 'CommentsController:index');

	$app->group('', function() {
		$this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
		$this->post('/auth/signin', 'AuthController:postSignIn');

		$this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
		$this->post('/auth/signup', 'AuthController:postSignUp');
		$this->post('/auth/password', 'PasswordController:postChangePassword');

	})->add(new GuestMiddleware($container));

	

	$app->group('', function() {
		$this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
	})->add(new AuthMiddleware($container));

?>