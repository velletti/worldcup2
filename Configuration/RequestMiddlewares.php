<?php

return [
    'frontend' => [
        'jve/worldcup2/ajax' => [
            'target' => \JVE\Worldcup2\Middleware\Ajax::class,
            'after' => [
                'typo3/cms-frontend/authentication'
            ],
        ],
    ],
];
