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

    /** @var \DigitalFarm\Elasticsearch\QueryBuilder $queryBuilder */
    $queryBuilder = $app->getDI()->get('queryBuilder');

    $id = $app->request->get('id', 'int', null);
    $limit = (int)$app->request->get('limit', 'int', 20);
    $offset = (int)$app->request->get('offset', 'int', 0);

    $orderBy = $app->request->get('orderBy', 'string', 'id');
    $orderType = $app->request->get('orderType', 'string', 'DESC');

    if (!\in_array($orderType, ['ASC','DESC'])) {
        $orderType = 'DESC';
    }

    $onlyWithSalary = (int) $app->request->get('onlyWithSalary', 'int', 0);
    $word = $app->request->get('q', 'string');
    $country = $app->request->get('q', 'country');
    $cities = $app->request->get('cities') ?? [];
    $contractTypes = $app->request->get('contractTypes') ?? [];
    $seniorityList = $app->request->get('seniorityList') ?? [];
    $technologies = $app->request->get('technologies') ?? [];
    $categories = $app->request->get('categories') ?? [];
    $salaryMax = $app->request->get('salaryMax', 'int', null);
    $salaryMin = $app->request->get('salaryMin', 'int', null);

    if (!empty($cities)) {
        $queryBuilder->whereIn('companyCity', $cities);
    }

    if (!empty($categories)) {
        $queryBuilder->whereIn('category', $categories);
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

    if (!\is_null($id)){
        $queryBuilder->where('id', (int) $id);
    }

    if (!\is_null($country)){
        $queryBuilder->where('companyCountry', $country);
    }

    if (!\is_null($salaryMin)){
        $queryBuilder->whereGte('minEarnings', (int) $salaryMin);
    }

    if (!\is_null($salaryMax)){
        $queryBuilder->whereLte('maxEarnings', (int) $salaryMax);
    }

    if ($onlyWithSalary === 1 && \is_null($salaryMin)){
        $queryBuilder->whereGte('minEarnings', 0);
    }

    $queryBuilder->offset($offset);
    $queryBuilder->order($orderBy, $orderType);
    $queryBuilder->limit($limit);

    $data = $queryBuilder->search();

    \array_walk($data['hits']['hits'], function ($value, $key) use ($data) {
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
