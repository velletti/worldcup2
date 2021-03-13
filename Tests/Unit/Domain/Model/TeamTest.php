<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Tests\Unit\Domain\Model;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Jörg Velletti <typo3@velletti.de>
 */
class TeamTest extends UnitTestCase
{
    /**
     * @var \JVE\Worldcup2\Domain\Model\Team
     */
    protected $subject;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \JVE\Worldcup2\Domain\Model\Team();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFlagReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFlag()
        );
    }

    /**
     * @test
     */
    public function setFlagForStringSetsFlag()
    {
        $this->subject->setFlag('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'flag',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getShortcutfifaReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getShortcutfifa()
        );
    }

    /**
     * @test
     */
    public function setShortcutfifaForStringSetsShortcutfifa()
    {
        $this->subject->setShortcutfifa('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'shortcutfifa',
            $this->subject
        );
    }
}
