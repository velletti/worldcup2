<?php
defined('TYPO3_MODE') || die();

call_user_func(static function() {

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_worldcup2_domain_model_team', 'EXT:worldcup2/Resources/Private/Language/locallang_csh_tx_worldcup2_domain_model_team.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_worldcup2_domain_model_team');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_worldcup2_domain_model_bet', 'EXT:worldcup2/Resources/Private/Language/locallang_csh_tx_worldcup2_domain_model_bet.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_worldcup2_domain_model_bet');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_worldcup2_domain_model_game', 'EXT:worldcup2/Resources/Private/Language/locallang_csh_tx_worldcup2_domain_model_game.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_worldcup2_domain_model_game');

});
