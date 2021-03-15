<?php
defined('TYPO3_MODE') or die();

// Register plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'JVE.worldcup2',
    'Play',
    'Play Tipp Game',
    'worldcup2-plugin-play'
);


$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['worldcup2_play'] = 'pi_flexform';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['worldcup2_play'] = 'pages, recursive,select_key';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'worldcup2_play',
    'FILE:EXT:' . 'worldcup2' . '/Configuration/FlexForms/flexform_worldcup.xml'
);





