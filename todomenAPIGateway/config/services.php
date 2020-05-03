<?php

return [
    'workspaces'   =>  [
        'base_uri'  =>  env('WORKSPACES_SERVICE_BASE_URL'),
        'secret'  =>  env('WORKSPACES_SERVICE_SECRET'),
    ],

    'projects'   =>  [
        'base_uri'  =>  env('PROJECTS_SERVICE_BASE_URL'),
        'secret'  =>  env('PROJECTS_SERVICE_SECRET'),
    ],
];
