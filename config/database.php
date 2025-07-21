<?php

return [
    'database_connection' => [
        'driver'        => 'mysql',
        'host'          => env('CONN_PASAKAY_IP', config('jtpasakayconfig.conn_pasakay_ip')),
        'port'          => env('CONN_PASAKAY_PT', config('jtpasakayconfig.conn_pasakay_pt')),
        'database'      => env('CONN_PASAKAY_DB', config('jtpasakayconfig.conn_pasakay_db')),
        'username'      => env('CONN_PASAKAY_UN', config('jtpasakayconfig.conn_pasakay_un')),
        'password'      => env('CONN_PASAKAY_PW', config('jtpasakayconfig.conn_pasakay_pw')),
        'charset'       => 'utf8mb4',
        'collation'     => 'utf8mb4_unicode_ci',
        'prefix'        => ''
    ],
];