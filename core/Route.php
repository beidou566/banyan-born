<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


// $app->get('/hello', 'App\Controller\Hello:getStatusAPI')->setName('main_api');

$app->get('/', function (Request $request, Response $response, array $args): Response {
    $result = ['timestamp' => time()];
    $response->getBody()->write(json_encode($result));
    return $response            
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
});


$app->get('/test_log', function (Request $request, Response $response, array $args): Response {
// Sample log message
 $this->get('logger')->info(" write log is ok");
  $result = [
      'status' => [
          'code' => 200,
          'message' => 'OK'
      ]
  ];

  $response->getBody()->write(json_encode($result, JSON_PRETTY_PRINT));
  return $response->withStatus($result['status']['code'])
      ->withHeader('Content-Type', 'application/json;charset=UTF-8');
});

$app->get('/test_twig', function (Request $request, Response $response, array $args): Response {
    $viewData = ['message'=>"twig is ok !"];
    return  $this->get('view')->render($response,'hello.twig',$viewData);
});

$app->get('/test_db', function (Request $request, Response $response, array $args): Response {

    $data = $this->get('db')->select('article', ['id', 'title']);
     $response->getBody()->write(json_encode($data));
    return $response;
});

$app->get('/test_httpcache', function (Request $request, Response $response, array $args): Response {

     // Use the cache provider.
     $response = $this->get('httpcache')->withEtag($response, 'httpcache');
     $response->getBody()->write('httpcache!');
     return $response;
});

$app->get('/test_mvc', 'App\Action\HelloAction:handle');
