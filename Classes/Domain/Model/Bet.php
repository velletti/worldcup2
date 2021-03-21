<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Domain\Model;


/**
 * This file is part of the "Place WM and EM Bets" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Jörg Velletti <typo3@velletti.de>, Allplan GmbH
 * Bet
 */
class Bet extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * goalsteam1
     *
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $goalsteam1 = 0;


    /**
     * tstamp
     *
     * @var int
     */
    protected $tstamp = 0 ;

    /**
     * goalsteam2
     *
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $goalsteam2 = 0;

    /**
     * game
     *
     * @var \JVE\Worldcup2\Domain\Model\Game
     */
    protected $game = null;

    /**
     * feuser
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected $feuser = null;

    /**
     * Returns the goalsteam1
     *
     * @return int $goalsteam1
     */
    public function getGoalsteam1()
    {
        return $this->goalsteam1;
    }

    /**
     * Sets the goalsteam1
     *
     * @param int $goalsteam1
     * @return void
     */
    public function setGoalsteam1($goalsteam1)
    {
        $this->goalsteam1 = $goalsteam1;
        $this->tstamp = time();
    }

    /**
     * Returns the goalsteam2
     *
     * @return int $goalsteam2
     */
    public function getGoalsteam2()
    {
        return $this->goalsteam2;
    }

    /**
     * Sets the goalsteam2
     *
     * @param int $goalsteam2
     * @return void
     */
    public function setGoalsteam2($goalsteam2)
    {
        $this->goalsteam2 = $goalsteam2;
        $this->tstamp = time();
    }

    /**
     * Returns the game
     *
     * @return \JVE\Worldcup2\Domain\Model\Game $game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Sets the game
     *
     * @param \JVE\Worldcup2\Domain\Model\Game $game
     * @return void
     */
    public function setGame(\JVE\Worldcup2\Domain\Model\Game $game)
    {
        $this->game = $game;
        $this->tstamp = time();
    }

    /**
     * Returns the feuser
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feuser
     */
    public function getFeuser()
    {
        return $this->feuser;
    }

    /**
     * Sets the feuser
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feuser
     * @return void
     */
    public function setFeuser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feuser)
    {
        $this->feuser = $feuser;
        $this->tstamp = time();
    }

    /**
     * Returns the Points
     *
     * @return int
     */
    public function getPoints()
    {
        // just avoid error if game is deleted ..
        if( !$this->game ) {
            return 0 ;
        }
        // do not count this game at this moment ...
        if( !$this->game->isFinished() ) {
            return 0 ;
        }
        // bet of user is matching exactly game result ....
        if( $this->game->getGoalsteam1() == $this->getGoalsteam1() &&  $this->game->getGoalsteam2() == $this->getGoalsteam2()  ) {
            return 3;
        }

        // bet has correct winner and has same goal difference
        if( ($this->game->getGoalsteam1() - $this->getGoalsteam1()) ==  ( $this->game->getGoalsteam2() - $this->getGoalsteam2())  ) {
            return 2;
        }

        // bet has correct winner
        $winner = $this->theWinnerIs($this->game->getGoalsteam1() ,$this->game->getGoalsteam2() );
        $tipped = $this->theWinnerIs($this->getGoalsteam1(),$this->getGoalsteam2());
        if ($winner === $tipped  ) {
            return 1;
        }
        // bet wrong winner
        return 0 ;

    }

    /**
     * whichone of the teams is the winner? input: gloals - output winner
     *
     * @param integer $team1 : goals of team 1
     * @param integer $team2 : goals of team 2
     * @return    integer        0= tied, 1=team1...
     */
    function theWinnerIs (int $team1, int $team2) {
        if ($team1 > $team2) return 1;
        if ($team1 < $team2) return 2;

        return 0;
    }



}
