<?php

return [
    'workspaces'   =>  [
        'base_uri'  =>  env('WORKSPACES_SERVICE_BASE_URL'),
        'secret'  =>  env('WORKSPACES_SERVICE_SECRET'),
    ],

    'boards'   =>  [
        'base_uri'  =>  env('BOARDS_SERVICE_BASE_URL'),
        'secret'  =>  env('BOARDS_SERVICE_SECRET'),
    ],
];
