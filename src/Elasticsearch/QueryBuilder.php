<?php
declare(strict_types=1);

namespace DigitalFarm\Elasticsearch;

class QueryBuilder
{
    const MAX_ELEMENTS_IN_BATCH = 1500;

    protected \Elasticsearch\Client $client;

    protected array $params = [];

    protected int $counter = 0;

    /**
     * Manager constructor.
     * @param \Elasticsearch\Client $client
     */
    public function __construct(\Elasticsearch\Client $client)
    {
        $this->client = $client;
    }

    public function whereInRange(string $key, ?int $min = 0, ?int $max = null): self
    {
        $this->params['body']['query']['bool']['must']['range'][$key] = [
            'gte' => $min,
            'lte' => $max
        ];

        return $this;
    }

    public function whereGte(string $key, int $limit): self
    {
        $this->params['body']['query']['bool']['must']['range'][$key] = [
            'gte' => $limit,
        ];

        return $this;
    }

    public function whereLte(string $key, int $limit): self
    {
        $this->params['body']['query']['bool']['must']['range'][$key] = [
            'lte' => $limit,
        ];

        return $this;
    }

    public function offset(int $limit): self
    {

        $this->params['from'] = $limit;

        return $this;
    }

    public function order(string $columnName, string $orderType = 'ASC'): self
    {
        $this->params['sort'] = [$columnName . ':' . \mb_strtolower($orderType)];

        return $this;
    }

    public function limit(int $limit): self
    {

        $this->params['size'] = $limit;

        return $this;
    }

    public function whereIn(string $key, array $values): self
    {
        $this->counter++;

        $this->params['body']['query']['bool']['should'] = $this->params['body']['query']['bool']['should'] ?? [];
        foreach ($values as $value) {
            $this->params['body']['query']['bool']['should'][] = [
                'match' => [
                    $key => $value
                ]
            ];
        }

        $this->params['body']['query']['bool']['minimum_should_match'] = $this->counter;

        return $this;
    }

    public function whereWord(string $search): self
    {
        $this->counter++;
        $this->params['body']['query']['bool']['should'] = [
            [
                'query_string' => [
                    'default_field' => 'textSearch',
                    'query' => '*' . $search . '*',
                    'boost'=> '2.0',
                    'fuzziness' => 3
                ]
            ]
        ];

        $this->params['body']['query']['bool']['minimum_should_match'] = $this->counter;

        return $this;
    }

    public function where(string $key, string $value): self
    {
        $this->params['body']['query']['bool']['filter'] = [
            'term' => [
                $key => $value
            ]
        ];

        return $this;
    }

    public function search(): array
    {
        $this->params['scroll'] = '1s';
        $this->params['index'] = $this->findActiveIndex();

        $response = $this->client->search($this->params);
        while (isset($response['hits']['hits']) && count($response['hits']['hits']) > 0) {
            $scrollId = $response['_scroll_id'];
            $response = $this->client->scroll([
                'body' => [
                    'scroll_id' => $scrollId,
                    'scroll'    => '1s'
                ]
            ]);
        }

        return $response;
    }

    private function findActiveIndex(): ?string
    {
        $aliases = $this->client->indices()->getAliases();
        foreach ($aliases as $index => $aliasMapping) {
            if (\array_key_exists('offers', $aliasMapping['aliases'])) {
                return $index;
            }
        }

        return null;
    }


}