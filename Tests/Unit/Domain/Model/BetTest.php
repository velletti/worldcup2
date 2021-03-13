<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Tests\Unit\Domain\Model;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Jörg Velletti <typo3@velletti.de>
 */
class BetTest extends UnitTestCase
{
    /**
     * @var \JVE\Worldcup2\Domain\Model\Bet
     */
    protected $subject;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \JVE\Worldcup2\Domain\Model\Bet();
    }

    protected function tearDown()
    {
        parent::tearDown();
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
    public function getGameReturnsInitialValueForGame()
    {
        self::assertEquals(
            null,
            $this->subject->getGame()
        );
    }

    /**
     * @test
     */
    public function setGameForGameSetsGame()
    {
        $gameFixture = new \JVE\Worldcup2\Domain\Model\Game();
        $this->subject->setGame($gameFixture);

        self::assertAttributeEquals(
            $gameFixture,
            'game',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFeuserReturnsInitialValueForFrontendUser()
    {
    }

    /**
     * @test
     */
    public function setFeuserForFrontendUserSetsFeuser()
    {
    }
}
