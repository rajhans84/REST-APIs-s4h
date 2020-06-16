<?php

	namespace App\Controllers;

	use App\Models\User;
	use Slim\Views\Twig as View;

	class HomeController extends Controller
	{
		public function index($request, $response)
		{
			$data = new \stdClass;
			return $response->withJson($data, 200);
		}
	}

?>