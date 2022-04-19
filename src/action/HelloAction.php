<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class HelloAction extends Action
{

    public function handle(Request $request, Response $response): Response
    {
        $this->logger->info('Home page handler dispatched');

        // $name = $request->getAttribute('name', 'world');
        // $response->getBody()->write("Hello $name");
        $result['status'] = true;
        $result['message'] = "Hello name";
        return $this->withJson($response, $result);
    }

}
