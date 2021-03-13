<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Tests\Unit\Controller;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Jörg Velletti <typo3@velletti.de>
 */
class GameControllerTest extends UnitTestCase
{
    /**
     * @var \JVE\Worldcup2\Controller\GameController
     */
    protected $subject;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\JVE\Worldcup2\Controller\GameController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenGameToView()
    {
        $game = new \JVE\Worldcup2\Domain\Model\Game();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('game', $game);

        $this->subject->showAction($game);
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenGameToView()
    {
        $game = new \JVE\Worldcup2\Domain\Model\Game();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('game', $game);

        $this->subject->showAction($game);
    }
}
