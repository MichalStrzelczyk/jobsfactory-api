<?php
declare(strict_types=1);

namespace DigitalFarm\Elasticsearch;

class QueryBuilder
{
    const MAX_ELEMENTS_IN_BATCH = 1500;

    protected \Elasticsearch\Client $client;

    protected array $params = [];

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
        $this->params['body']['query']['bool']['filter']['range'][$key] = [
            'gte' => $min,
            'lte' => $max
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
        $this->params['sort'] = [$columnName . ':' . $orderType];

        return $this;
    }

    public function limit(int $limit): self
    {

        $this->params['size'] = $limit;

        return $this;
    }

    public function whereIn(string $key, array $values): self
    {

        $this->params['body']['query']['bool']['should'] = $this->params['body']['query']['bool']['should'] ?? [];
        foreach ($values as $value) {
            $this->params['body']['query']['bool']['should'][] = [
                'match' => [
                    $key => $value
                ]
            ];
        }

        return $this;
    }

    public function whereWord(string $search): self
    {
        $this->params['body']['query']['bool']['should'] = [
            [
                'query_string' => [
                    'default_field' => 'position',
                    'query' => '*' . $search . '*',
                    'boost'=> '2.0',
                    'fuzziness' => 3
                ]
            ],
            [
                'query_string' => [
                    'default_field' => 'description',
                    'query' => '*' . $search . '*',
                    'boost'=> '1.5'
                ]
            ],
            [
                'query_string' => [
                    'default_field' => 'technologies',
                    'query' => '*' . $search . '*',
                    'boost'=> '1.2'
                ]
            ],
            [
                'query_string' => [
                    'default_field' => 'companyName',
                    'query' => '*' . $search . '*'
                ]
            ],
            [
                'query_string' => [
                    'default_field' => 'companyCity',
                    'query' => '*' . $search . '*'
                ]
            ]
        ];


        return $this;
    }

    public function where(string $key, string $value): self
    {

        $this->params['body']['query']['bool']['must'] = $this->params['body']['query']['bool']['must'] ?? [];

        $this->params['body']['query']['bool']['must'][] = [
            'match' => [
                $key => $value
            ]
        ];

        return $this;
    }

    public function search(): array
    {
        $this->params['index'] = $this->findActiveIndex();

        return $this->client->search($this->params);
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