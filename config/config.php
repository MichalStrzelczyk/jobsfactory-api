<?php

return new \Phalcon\Config(
    [
        'database' => [
            'adapter' => 'Postgresql',
            'host' => '172.16.0.2',
            'username' => 'postgres',
            'password' => 'Mamma1.2',
            'dbname' => 'it-offers'
        ],
        'elasticsearch' => [
            'host' => '172.16.0.5',
            'port' => 9200
        ],
        'version' => '1.0',
        'application' => [
            'modelsDir'      => BASE_PATH . '/models/',
            'migrationsDir'  => BASE_PATH . '/migrations/',
            'viewsDir'       => BASE_PATH . '/views/',
            'baseUri'        => '/',
        ]
    ]
);
