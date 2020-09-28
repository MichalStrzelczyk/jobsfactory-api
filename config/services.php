<?php
declare(strict_types=1);

use Phalcon\Mvc\View\Simple as View;
use Phalcon\Url as UrlResolver;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include BASE_PATH . '/config/config.php';
});

$di->setShared('elasticsearch', function () {
    $config = $this->getConfig()->elasticsearch;

    return \Elasticsearch\ClientBuilder::create()
        ->setHosts([$config['host'].':'.$config['port']])
        ->build();
});

$di->setShared('queryBuilder', function () use ($di) {
    return new \DigitalFarm\Elasticsearch\QueryBuilder($di->getShared('elasticsearch'));
});

/**
 * Sets the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    return $view;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});
