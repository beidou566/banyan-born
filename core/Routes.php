<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;


// $app->get('/', 'App\Controller\Hello:getStatus')->setName('main');
// $app->get('/hello', 'App\Controller\Hello:getStatusAPI')->setName('main_api');

$app->get('/test', function (Request $request, Response $response, array $args): Response {
// Sample log message
    $this->get('logger')->info("Main/ Home route generic '/' route");
  $data = [
      'status' => [
          'code' => 200,
          'message' => 'OK'
      ]
  ];
  $payload = json_encode($data, JSON_PRETTY_PRINT);
  $response->getBody()->write($payload);
  return $response->withStatus($data['status']['code'])
      ->withHeader('Content-Type', 'application/json;charset=UTF-8');
});

$app->get('/test_twig', function (Request $request, Response $response, array $args): Response {

    $viewData = ['message'=>"Hello world!"];
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
