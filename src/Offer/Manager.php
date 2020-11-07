<?php
declare(strict_types=1);

namespace DigitalFarm\Offer;

class Manager
{
    protected \Phalcon\Mvc\Micro $app;

    public function __construct(\Phalcon\Mvc\Micro $app)
    {
        $this->app = $app;
    }

    public function search(): array
    {
        /** @var \DigitalFarm\Elasticsearch\QueryBuilder $queryBuilder */
        $queryBuilder = $this->app->getDI()->get('queryBuilder');

        $id = $this->app->request->get('id', 'int', null);
        $limit = (int)$this->app->request->get('limit', 'int', 20);
        $offset = (int)$this->app->request->get('offset', 'int', 0);

        $orderBy = $this->app->request->get('orderBy', 'string', 'id');
        $orderType = $this->app->request->get('orderType', 'string', 'DESC');

        if (!\in_array($orderType, ['ASC', 'DESC'])) {
            $orderType = 'DESC';
        }

        $onlyWithSalary = (int)$this->app->request->get('onlyWithSalary', 'int', 0);
        $word = $this->app->request->get('q', 'string');
        $country = $this->app->request->get('country', 'string');
        $cities = $this->app->request->get('cities') ?? [];
        $contractTypes = $this->app->request->get('contractTypes') ?? [];
        $seniorityList = $this->app->request->get('seniorityList') ?? [];
        $technologies = $this->app->request->get('technologies') ?? [];
        $categories = $this->app->request->get('categories') ?? [];
        $salaryMax = $this->app->request->get('salaryMax', 'int', null);
        $salaryMin = $this->app->request->get('salaryMin', 'int', null);

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

        if (!\is_null($id)) {
            $queryBuilder->where('id', (int)$id);
        }

        if (!\is_null($country)) {
            $queryBuilder->where('companyCountry', $country);
        }

        if (!\is_null($salaryMin)) {
            $queryBuilder->whereGte('minEarnings', (int)$salaryMin);
        }

        if (!\is_null($salaryMax)) {
            $queryBuilder->whereLte('maxEarnings', (int)$salaryMax);
        }

        if ($onlyWithSalary === 1 && \is_null($salaryMin)) {
            $queryBuilder->whereGte('minEarnings', 0);
        }

        $queryBuilder->offset($offset);
        $queryBuilder->order($orderBy, $orderType);
        $queryBuilder->limit($limit);

        $data = $queryBuilder->search();

        \array_walk($data['hits']['hits'], function ($value, $key) use ($data) {
            $data['hits']['hits'][$key] = $value['_source'];
        }, ARRAY_FILTER_USE_BOTH);

        return $data;
    }
}