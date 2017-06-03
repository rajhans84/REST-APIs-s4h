<?php
	
	use App\Middleware\AuthMiddleware;
	use App\Middleware\GuestMiddleware;

	$app->get('/', 'HomeController:index')->setName('home');
	// TODO: Add authentication mechanism for API 
	$app->get('/posts', 'PostsController:index');
	$app->post('/posts', 'PostsController:store');
	$app->post('/comments', 'PostsController:comments');

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