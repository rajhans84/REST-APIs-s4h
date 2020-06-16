<?php

	use App\Auth\Auth as Auth;
	use App\Controllers\Auth\AuthController as AuthController;
	use App\Controllers\Auth\PasswordController as PasswordController;
	use App\Controllers\CommentsController as CommentsController;
	use App\Controllers\LikesController as LikesController;
	use App\Controllers\HomeController as HomeController;
	use App\Controllers\PostsController as PostsController;
	use App\Middleware\OldInputMiddleware as OldInputMiddleware;
	use App\Middleware\ValidationErrorsMiddleware as ValidationErrorsMiddleware;
	use App\Validation\Rules as Rules;
	use App\Validation\Validator as Validator;
	use Illuminate\Database\Capsule\Manager as Capsule;
	use Respect\Validation\Validator as v;
	use Slim\Csrf\Guard as Guard;
	use Slim\Flash\Messages as Messages;
	use Slim\Views\Twig as Twig;
	use Slim\Views\TwigExtension as TwigExtension;

	session_start();

	require __DIR__ . '/../vendor/autoload.php';

	$app = new \Slim\App([
		'settings' => [
			'determineRouteBeforeAppMiddleware' => true,
			'displayErrorDetails' => true,
			'addContentLengthHeader' => false,
			'db' => [
				'driver' => 'mysql',
		    'host' => 'localhost',
		    'database' => 'share4happiness',
		    'username' => 'root',
		    'password' => 'root',
		    'charset' => 'latin1',
		    'collation' => 'latin1_spanish_ci',
		    'prefix' => '',
			]
		],
		
	]);

	$container = $app->getContainer();

	$capsule = new Capsule;
	$capsule->addConnection($container['settings']['db']);
	$capsule->setAsGlobal();
	$capsule->bootEloquent();
	$container['db'] = function ($container) use ($capsule){
		return $capsule;
	};

	$container['auth'] = function($container) {

		return new Auth;
	};

	$container['flash'] = function($container) {
		return new Messages;
	};

	$container['view'] = function($container) {

		$view = new Twig(__DIR__ . '/../resources/views', [
			'cache' => false,
		]);

		$view->addExtension(new TwigExtension(
			$container->router,
			$container->request->getUri()
		));

		$view->getEnvironment()->addGlobal('auth', [
			'check' => $container->auth->check(),
			'user' => $container->auth->user(),
		]);

		$view->getEnvironment()->addGlobal('flash', $container->flash);

		return $view;
	};

	$container['validator'] = function($container) {

		return new Validator;
	};

	$container['HomeController'] = function($container) {

		return new HomeController($container);
	};

	$container['AuthController'] = function($container) {

		return new AuthController($container);
	};

	$container['PasswordController'] = function($container) {

		return new PasswordController($container);
	};

	$container['PostsController'] = function($container) {

		return new PostsController($container);
	};

	$container['CommentsController'] = function($container) {
		
		return new CommentsController($container);
	};
	
	$container['LikesController'] = function($container) {
		
		return new LikesController($container);
	};
	
	$container['csrf'] = function($container) {

		return new Guard;
	};

	$app->add(new ValidationErrorsMiddleware($container));
	$app->add(new OldInputMiddleware($container));
	// $app->add(new MediaTypeParserMiddleware($container));
	// $app->add(new CsrfViewMiddleware($container));

	// $app->add($container->csrf);

	v::with('App\\Validation\\Rules');

	require __DIR__ . '/../app/routes.php';

?>