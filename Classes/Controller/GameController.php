<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Controller;


use Allplan\NemConnections\Utility\MigrationUtility;
use JVE\Worldcup2\Domain\Model\Bet;
use JVE\Worldcup2\Domain\Model\Game;
use JVE\Worldcup2\Domain\Repository\GameRepository;
use JVE\Worldcup2\Domain\Repository\BetRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "Place WM and EM Bets" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Jörg Velletti <typo3@velletti.de>, Allplan GmbH
 * GameController
 */
class GameController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * gameRepository
     *
     * @var GameRepository
     */
    protected $gameRepository = null;

    /**
     * betRepository
     *
     * @var BetRepository
     */
    protected $betRepository = null;

    /**
     * @var array|null
     */
    protected $currentUser = null ;


    /**
     * @param GameRepository $gameRepository
     */
    public function injectGameRepository(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param BetRepository $betRepository
     */
    public function injectBetRepository(BetRepository $betRepository)
    {
        $this->betRepository = $betRepository;
    }

    public function initializeAction()
    {
        parent::initializeAction();

        $context = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Context\Context::class) ;
        $languageAspect = $context->getAspect('language') ;
        if ( $context->getPropertyFromAspect('frontend.user', "isLoggedIn") ) {
            $this->currentUser['id'] = $context->getPropertyFromAspect('frontend.user', "id") ;
            $this->currentUser['username'] = $context->getPropertyFromAspect('frontend.user', "username") ;
            $this->currentUser['groupIds'] = $context->getPropertyFromAspect('frontend.user', "groupIds") ;
        } else {
            $this->currentUser['id'] = 0 ;
            $this->currentUser['username'] = '';
            $this->currentUser['groupIds'] = '';
        }

        if (GeneralUtility::_GP("L") && intval(GeneralUtility::_GP("L") > 0)) {
            $this->settings["sys_langauge_uid"] = intval(GeneralUtility::_GP("L"));
        } else {
            $this->settings["sys_langauge_uid"] = $languageAspect->getId() ;
        }

    }

    /**
     * action next
     *
     * @return string|object|null|void
     */
    public function nextAction()
    {
        $games = $this->gameRepository->findByDate( 2) ;
        if($this->request->hasArgument("user")) {
            $user = (int)$this->request->getArgument("user") ;
            $this->view->assign("requestedUser" , true ) ;
        } else {
            $user = $this->currentUser['id'] ;
            $this->view->assign("requestedUser" , false ) ;
        }

        if( $games) {
            /** @var Game $game */
            foreach ($games as $game) {
                /** @var Bet $bet */
                $bet = $this->betRepository->findbyGameAndUser($game->getUid() , $user ) ;
                $game->setUserbet($bet);
            }
        }
        $this->view->assign("games" , $games ) ;
        $this->view->assign("currentUser" , $this->currentUser ) ;

    }

    /**
     * action listgroups
     *
     * @return string|object|null|void
     */
    public function listgroupsAction()
    {
    }

    /**
     * action showbet
     *
     * @return string|object|null|void
     */
    public function showbetAction()
    {
    }

    /**
     * action ranking
     *
     * @return string|object|null|void
     */
    public function rankingAction()
    {
    }

    /**
     * action showgroup
     *
     * @return string|object|null|void
     */
    public function showgroupAction()
    {
    }
}
