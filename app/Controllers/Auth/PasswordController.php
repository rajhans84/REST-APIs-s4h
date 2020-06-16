<?php

	namespace App\Controllers\Auth;

	use App\Models\User;
	use App\Controllers\Controller;
	use Respect\Validation\Validator as v;

	class PasswordController extends Controller
	{
		public function postChangePassword($request, $response)
		{
			die(print_r($request->getParsedBody()));
			$validation = $this->validator->validate($request, [
				'password_old' => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
				'password' => v::noWhitespace()->notEmpty(),
			]);

			$data = new \stdClass;

			if($validation->failed()) {
				return $response->withJson($data, 422);
			}

			$this->auth->user()->setPassword($request->getParam('password'));

			return $response->withJson($data, 204);
		}
	}

?>