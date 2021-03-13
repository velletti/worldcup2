<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Controller;


use JVE\Worldcup2\Domain\Repository\GameRepository;

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
     * @param GameRepository $gameRepository
     */
    public function injectGameRepository(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function initializeAction()
    {
        parent::initializeAction();

    }

    /**
     * action next
     *
     * @return string|object|null|void
     */
    public function nextAction()
    {
        $this->view->assign("games" , $this->gameRepository->findByDate(2)) ;
       // $this->view->assign("currentUser" , ) ;
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
