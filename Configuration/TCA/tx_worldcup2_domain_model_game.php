<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_game',
        'label' => 'playtime',
        'label_alt' => 'team1,team2',
        'label_alt_force' => 1,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        "default_sortby" => "finished ASC, playtime ASC",
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => '',
        'iconfile' => 'EXT:worldcup2/Resources/Public/Icons/tx_worldcup2_domain_model_game.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, playtime, goalsteam1, goalsteam2, round, team1, team2',
    ],
    'types' => [
        '1' => ['showitem' => ' l10n_diffsource,  --palette--;;advanced, --palette--;;infos, --palette--;;teams'],
    ],
    'palettes' => [
        'advanced' => ['showitem' => 'sys_language_uid, hidden , --linebreak--, l10n_parent'],
        'infos' => ['showitem' => 'playtime,  round, --linebreak--, remark'],
        'teams' => ['showitem' => 'team1 ,  team2 , --linebreak--, goalsteam1, goalsteam2, --linebreak--, finished'],
    ] ,

    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => -1,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_worldcup2_domain_model_game',
                'foreign_table_where' => 'AND {#tx_worldcup2_domain_model_game}.{#pid}=###CURRENT_PID### AND {#tx_worldcup2_domain_model_game}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'finished' => [
            'exclude' => true,
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_game.finished',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
            ],
        ],

        'playtime' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_game.playtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime,required',
                'default' => time()
            ],
        ],
        'goalsteam1' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_game.goalsteam1',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'goalsteam2' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_game.goalsteam2',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'round' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_game.round',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.A", "A"),
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.B", "B"),
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.C", "C"),
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.D", "D"),
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.E", "E"),
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.F", "F"),
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.G", "G"),
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.H", "H"),
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.16", "16"),
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.8", "8"),
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.4", "4"),
                    Array("LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_games.round.I.2", "2")
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ],
        ],
        'team1' => [
            'exclude' => true,
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_game.team1',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_worldcup2_domain_model_team',
                'foreign_table_where' => ' AND tx_worldcup2_domain_model_team.pid = ###CURRENT_PID###  ORDER BY tx_worldcup2_domain_model_team.name',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
        'team2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_game.team2',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_worldcup2_domain_model_team',
                'foreign_table_where' => ' AND tx_worldcup2_domain_model_team.pid = ###CURRENT_PID### ORDER BY tx_worldcup2_domain_model_team.name',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
        'remark' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_game.remark',
            'config' => [
                'type' => 'input',
                'size' => 100,
                'eval' => 'trim'
            ]
        ],

    ],
];
