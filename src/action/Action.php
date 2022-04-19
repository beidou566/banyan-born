<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Action 
{
    protected $logger;
    protected $view;
    public function __construct(\Psr\Container\ContainerInterface $c)
    {
        $this->logger=$c->get('logger');
        $this->view=$c->get('view');
    }

    function withJson(
        Response $response,
        array $data,
        int $status = 200
        ):  Response {
        $response->getBody()->write(json_encode($data));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }

}
