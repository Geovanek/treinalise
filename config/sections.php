<?php

return [
    'sections' => [
        'app' => [
            'company' => [
                'layout' => 'app.company.layouts.company'
            ],
            'athlete' => [
                'layout' => 'app.company.layouts.athlete'
            ],
        ],
        'admin' => [
            'layout' => 'admin.layouts.admin'
        ],
        'home' => [
            'login' => [
                'App_Models_Admin' => [
                    'redirect' => '/admin/dashboard',
                    'guard' => 'admin_web',
                ],
                'App_Models_Coach' => [
                    'redirect' => '/app/company/coach',
                    'guard' => 'coach_web',
                ],
                'App_Models_Athlete' => [
                    'redirect' =>'/app/athlete/home',
                    'guard' => 'athlete_web',
                ],
            ]
        ]
    ]
];