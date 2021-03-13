<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Tests\Unit\Domain\Model;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Jörg Velletti <typo3@velletti.de>
 */
class GameTest extends UnitTestCase
{
    /**
     * @var \JVE\Worldcup2\Domain\Model\Game
     */
    protected $subject;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \JVE\Worldcup2\Domain\Model\Game();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getPlaytimeReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getPlaytime()
        );
    }

    /**
     * @test
     */
    public function setPlaytimeForDateTimeSetsPlaytime()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setPlaytime($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'playtime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGoalsteam1ReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getGoalsteam1()
        );
    }

    /**
     * @test
     */
    public function setGoalsteam1ForIntSetsGoalsteam1()
    {
        $this->subject->setGoalsteam1(12);

        self::assertAttributeEquals(
            12,
            'goalsteam1',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getGoalsteam2ReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getGoalsteam2()
        );
    }

    /**
     * @test
     */
    public function setGoalsteam2ForIntSetsGoalsteam2()
    {
        $this->subject->setGoalsteam2(12);

        self::assertAttributeEquals(
            12,
            'goalsteam2',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRoundReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getRound()
        );
    }

    /**
     * @test
     */
    public function setRoundForIntSetsRound()
    {
        $this->subject->setRound(12);

        self::assertAttributeEquals(
            12,
            'round',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTeam1ReturnsInitialValueForTeam()
    {
        self::assertEquals(
            null,
            $this->subject->getTeam1()
        );
    }

    /**
     * @test
     */
    public function setTeam1ForTeamSetsTeam1()
    {
        $team1Fixture = new \JVE\Worldcup2\Domain\Model\Team();
        $this->subject->setTeam1($team1Fixture);

        self::assertAttributeEquals(
            $team1Fixture,
            'team1',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTeam2ReturnsInitialValueForTeam()
    {
        self::assertEquals(
            null,
            $this->subject->getTeam2()
        );
    }

    /**
     * @test
     */
    public function setTeam2ForTeamSetsTeam2()
    {
        $team2Fixture = new \JVE\Worldcup2\Domain\Model\Team();
        $this->subject->setTeam2($team2Fixture);

        self::assertAttributeEquals(
            $team2Fixture,
            'team2',
            $this->subject
        );
    }
}
