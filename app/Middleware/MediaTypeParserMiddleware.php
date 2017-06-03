<?php

	namespace App\Middleware;

	class MediaTypeParserMiddleware extends Middleware
	{
		public function __invoke($request, $response, $next)
		{
            // implement your parser here...
			$request->registerMediaTypeParser(
                "application/json",
                function ($input) {
                    return json_decode($input, true);
                }
            );

			$response = $next($request, $response);
			return $response;
		}
	}

?>