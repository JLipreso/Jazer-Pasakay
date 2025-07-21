<?php

return [
    /** Project Configurations */
    'project_refid'                 => env('PROJECT_REFID', ''),


    /** Database Connection Configurations */
    'conn_pasakay_ip'                 => env('CONN_PASAKAY_IP', env('DB_HOST')),
    'conn_pasakay_pt'                 => env('CONN_PASAKAY_PT', env('DB_PORT')),
    'conn_pasakay_db'                 => env('CONN_PASAKAY_DB', env('DB_DATABASE')),
    'conn_pasakay_un'                 => env('CONN_PASAKAY_UN', env('DB_USERNAME')),
    'conn_pasakay_pw'                 => env('CONN_PASAKAY_PW', env('DB_PASSWORD')),

    /** Query parameters */
    'fetch_paginate_max'            => env('FETCH_PAGINATE_MAX', 25),

     /** API KEY */
    "google_map_api_key"        => "AIzaSyD6LoE8AK-28QW-LTWtTSx68Alum0ft94g",
];