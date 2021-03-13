<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_bet',
        'label' => 'goalsteam1',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => '',
        'iconfile' => 'EXT:worldcup2/Resources/Public/Icons/tx_worldcup2_domain_model_bet.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, goalsteam1, goalsteam2, game, feuser',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, goalsteam1, goalsteam2, game, feuser'],
    ],
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
                'default' => 0,
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
                'foreign_table' => 'tx_worldcup2_domain_model_bet',
                'foreign_table_where' => 'AND {#tx_worldcup2_domain_model_bet}.{#pid}=###CURRENT_PID### AND {#tx_worldcup2_domain_model_bet}.{#sys_language_uid} IN (-1,0)',
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

        'goalsteam1' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_bet.goalsteam1',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int,required'
            ]
        ],
        'goalsteam2' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_bet.goalsteam2',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int,required'
            ]
        ],
        'game' => [
            'exclude' => true,
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_bet.game',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_worldcup2_domain_model_game',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
        'feuser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_domain_model_bet.feuser',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
    
    ],
];
