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

    // Validation
//    if ($this->request->isAjax()) {
//
//    }

    /** @var \DigitalFarm\Elasticsearch\QueryBuilder $queryBuilder */
    $queryBuilder = $app->getDI()->get('queryBuilder');

    $limit = (int)$app->request->get('limit', 'int', 20);
    $offset = (int)$app->request->get('offset', 'int', 0);

    $word = $app->request->get('q', 'string');
    $cities = $app->request->get('cities') ?? [];
    $contractTypes = $app->request->get('contractTypes') ?? [];
    $seniorityList = $app->request->get('seniorityList') ?? [];
    $technologies = $app->request->get('technologies') ?? [];
    $salaryMax = (int)$app->request->get('salaryMax', 'int', 999999);
    $salaryMin = (int)$app->request->get('salaryMin', 'int', 0);

    if (!empty($cities)) {
        $queryBuilder->whereIn('companyCity', $cities);
    }

    if (!empty($technologies)) {
        $queryBuilder->whereIn('mainTechnology', $technologies);
    }

    if (!empty($contractTypes)) {
        $queryBuilder->whereIn('employmentType', $contractTypes);
    }

    if (!empty($seniorityList)) {
        $queryBuilder->whereIn('seniority', $seniorityList);
    }

    if (!is_null($word)) {
        $queryBuilder->whereWord($word);
    }

    $queryBuilder->whereInRange('maxEarnings', $salaryMin, $salaryMax);
    $queryBuilder->offset($offset);
    $queryBuilder->limit($limit);

    $data = $queryBuilder->search();

    \array_walk($data['hits']['hits'], function($value, $key) use ($data){
        $data['hits']['hits'][$key] = $value['_source'];
    }, ARRAY_FILTER_USE_BOTH);

    $app->response->setContentType('application/json', 'UTF-8');
    $app->response->setHeader('Access-Control-Allow-Origin', "*");
    $app->response->sendHeaders();

    echo \json_encode([
        'total' => $data['hits']['total']['value'],
        'data' => $data['hits']['hits']
    ]);

});


/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});
