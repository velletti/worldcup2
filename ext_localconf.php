<?php
defined('TYPO3_MODE') || die();

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'JVE.Worldcup2',
            'Play',
            [
                'Game' => 'next,listgroups,showgroup,showagb,ranking'
            ],
            // non-cacheable actions
            [
                'Game' => 'next,listgroups,showgroup,showagb'
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        play {
                            iconIdentifier = worldcup2-plugin-play
                            title = LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_play.name
                            description = LLL:EXT:worldcup2/Resources/Private/Language/locallang_db.xlf:tx_worldcup2_play.description
                            tt_content_defValues {
                                CType = list
                                list_type = worldcup2_play
                            }
                        }
                    }
                    show = *
                }
           }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

			$iconRegistry->registerIcon(
				'worldcup2-plugin-play',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:worldcup2/Resources/Public/Icons/user_plugin_play.svg']
			);

    }
);
