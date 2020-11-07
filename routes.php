<?php

/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/**
 * Add your routes here
 */
$app->get('/status', function () use ($app) {
    echo json_encode([
        'status' => 'ok',
        'phalcon' => \Phalcon\Version::get()
    ]);
});

$app->get('/', function () use ($app) {
    $manager = new \DigitalFarm\Offer\Manager($app);
    $data = $manager->search();

    $app->response->setContentType('application/json', 'UTF-8');
    $app->response->setHeader('Access-Control-Allow-Origin', "*");
    $app->response->sendHeaders();

    echo \json_encode([
        'total' => $data['hits']['total']['value'],
        'data' => $data['hits']['hits']
    ]);

});

$app->get('/advertisement', function () use ($app) {
    $manager = new \DigitalFarm\Advertisement\Manager($app);
    $data = $manager->get();

    $app->response->setContentType('application/json', 'UTF-8');
    $app->response->setHeader('Access-Control-Allow-Origin', "*");
    $app->response->sendHeaders();

    echo \json_encode($data);
});


/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});
