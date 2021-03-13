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
    }
}
