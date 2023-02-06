<?php

return [
    'enable-secrets-manager' => env('ENABLE_SECRETS_MANAGER', false),
    'tag-name' => env('AWS_SECRETS_TAG_NAME', 'stage'),
    'tag-value' => env('AWS_SECRETS_TAG_VALUE', 'dev'),    
    'enabled-environments' => [
        'production',
        'local',
    ],
    'variables-config' => [
        'DB_PASSWORD'   => 'database.connections.mysql.password',
        'DB_DATABASE'   => 'database.connections.mysql.database',
        'DB_USERNAME'   => 'database.connections.mysql.username',
        'DB_PORT'       => 'database.connections.mysql.port',
        'DB_HOST'       => 'database.connections.mysql.host',
        'DB_CONNECTION' => 'database.default',
    ],
    'debug' =>  env('APP_DEBUG', false),
    'region' => 'ap-southeast-2',
    'version' => '2017-10-17',
    'profile' => 'default',

];