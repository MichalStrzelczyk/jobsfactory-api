<?php

return new \Phalcon\Config(
    [
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
