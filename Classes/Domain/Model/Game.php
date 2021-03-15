<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Domain\Model;


/**
 * This file is part of the "Place WM and EM Bets" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Jörg Velletti <typo3@velletti.de>, Allplan GmbH
 * Game
 */
class Game extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * playtime
     *
     * @var \DateTime
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $playtime = null;

    /**
     * goalsteam1
     *
     * @var int
     */
    protected $goalsteam1 = 0;

    /**
     * goalsteam2
     *
     * @var int
     */
    protected $goalsteam2 = 0;

    /**
     * userbet
     *
     * @var \JVE\Worldcup2\Domain\Model\Bet
     */
    protected $userbet = null ;

    /**
     * round
     *
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $round = 0;

    /**
     * team1
     *
     * @var \JVE\Worldcup2\Domain\Model\Team
     */
    protected $team1 = null;

    /**
     * team2
     *
     * @var \JVE\Worldcup2\Domain\Model\Team
     */
    protected $team2 = null;

    /**
     * @var bool
     */
    protected $finished = false;

    /**
     * next Game
     */

    protected  $nextGame =false ;



    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
    }


    /**
     * Returns the playtime
     *
     * @return \DateTime $playtime
     */
    public function getPlaytime()
    {
        return $this->playtime;
    }

    /**
     * Sets the playtime
     *
     * @param \DateTime $playtime
     * @return void
     */
    public function setPlaytime(\DateTime $playtime)
    {
        $this->playtime = $playtime;
    }

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
    }

    /**
     * Returns the round
     *
     * @return int $round
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * Sets the round
     *
     * @param int $round
     * @return void
     */
    public function setRound($round)
    {
        $this->round = $round;
    }

    /**
     * Returns the team1
     *
     * @return \JVE\Worldcup2\Domain\Model\Team $team1
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Sets the team1
     *
     * @param \JVE\Worldcup2\Domain\Model\Team $team1
     * @return void
     */
    public function setTeam1(\JVE\Worldcup2\Domain\Model\Team $team1)
    {
        $this->team1 = $team1;
    }

    /**
     * Returns the team2
     *
     * @return \JVE\Worldcup2\Domain\Model\Team $team2
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Sets the team2
     *
     * @param \JVE\Worldcup2\Domain\Model\Team $team2
     * @return void
     */
    public function setTeam2(\JVE\Worldcup2\Domain\Model\Team $team2)
    {
        $this->team2 = $team2;
    }

    /**
     * @return bool
     */
    public function isFinished(): bool
    {
        return $this->finished;
    }

    /**
     * @param bool $finished
     */
    public function setFinished(bool $finished): void
    {
        $this->finished = $finished;
    }



    /********* Not stored in DB Table game ... adined in Controller on current or requested user **************** */

    /**
     * @return Bet
     */
    public function getUserbet(): ?Bet
    {
        return $this->userbet;
    }

    /**
     * @param Bet $userbet
     */
    public function setUserbet(?Bet $userbet): void
    {
        $this->userbet = $userbet;
    }

    public function isGameStartingSoon() {
        $now = new \DateTime("now");
        if( $now->modify('-1 hour')  < $this->playtime) {
            return false ;
        }
        return true ;
    }

    /**
     * @return bool
     */
    public function isNextGame(): bool
    {
        return $this->nextGame;
    }

    /**
     * @param bool $nextGame
     */
    public function setNextGame(bool $nextGame): void
    {
        $this->nextGame = $nextGame;
    }






}
