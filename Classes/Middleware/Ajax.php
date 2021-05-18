<?php

namespace JVE\Worldcup2\Middleware;

use JVE\Worldcup2\Domain\Model\Bet;
use JVE\Worldcup2\Domain\Model\Game;
use JVE\Worldcup2\Domain\Repository\BetRepository;
use JVE\Worldcup2\Domain\Repository\GameRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Http\Stream;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * Class Ajax
 * @package JVE\Worldcup2\Middleware
 */
class Ajax implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $_gp = $request->getQueryParams();
        // examples:
        // https://connectv9.allplan.com.ddev.site/?L=1&tx_worldcup2_ajax[game]=1&tx_worldcup2_ajax[goal1]=0&tx_worldcup2_ajax[goal2]=2
        if( is_array($_gp) && key_exists("tx_worldcup2_ajax" ,$_gp )  ) {
            $GLOBALS['TSFE']->set_no_cache();

            $output = $this->handleRequest( $_gp['tx_worldcup2_ajax']) ;


            $result = json_encode( $output) ;
            $body = new Stream('php://temp', 'rw');
            $body->write($result);
            return (new Response())
                ->withHeader('content-type', $output['content-type'] . '; charset=utf-8')
                ->withHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                ->withHeader('Pragma', 'public')
                ->withHeader('Expires', '0')

                ->withBody($body)
                ->withStatus($output['status']);

        }
        return $handler->handle($request);
    }
    private function handleRequest($_gp) {
        $output['input']['game'] = $this->cleanInput($_gp['game']) ;
        $output['input']['goal1'] = $this->cleanInput($_gp['goal1'], 99) ;
        $output['input']['goal2'] = $this->cleanInput($_gp['goal2'], 99 ) ;

        $GLOBALS['TSFE']->initUserGroups();
        $user = $GLOBALS['TSFE']->fe_user->user;


        if( $user ) {
            $objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
            /** @var FrontendUserRepository $feuserRepository */
            $feuserRepository = $objectManager->get('TYPO3\\CMS\\Extbase\\Domain\\Repository\\FrontendUserRepository');

            /** @var FrontendUser $feuser */
            $feuser = $feuserRepository->findByUid($user['uid'] ) ;

            $output['user'] = $user['uid'] ;
            // store / update bet .

            /** @var GameRepository $gameRepository */
            $gameRepository = $objectManager->get('JVE\\Worldcup2\\Domain\\Repository\\GameRepository');
            /** @var BetRepository $betRepository */
            $betRepository = $objectManager->get('JVE\\Worldcup2\\Domain\\Repository\\BetRepository');

            /** @var PersistenceManager $persistenceManager */
            $persistenceManager = $objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\PersistenceManagerInterface");

                /** @var Game $game */
            $game = $gameRepository->findByUid( $output['input']['game'] ) ;
            $output['debug'][__LINE__] = "init" ;
            if($game ) {
                $output['debug'][__LINE__] = "is game" ;
                if(!$game->isGameStartingSoon()) {
                    $output['debug'][__LINE__] = "Not starting soon" ;
                    $pid = $this->cleanInput($_gp['pid'])  ;

                    /** @var Bet $bet */
                    $bet = $betRepository->findByGameAndUser( $output['input']['game']  , $output['user'] , $pid ) ;
                    if( $bet instanceof Bet && $bet->getUid() > 0 ) {
                        $output['debug'][__LINE__] = "Found BET for Game " .$output['input']['game'] . " and " . $output['user']  . " Uid: " . $bet->getUid()  ;
                        $bet->setGoalsteam1( $output['input']['goal1']);
                        $bet->setGoalsteam2( $output['input']['goal2']);
                        if( $bet->getPoints() > 0) {
                            $output['debug'][__LINE__] = "bet too late" ;
                            // This may not happen: A bet may giv only points when not running.
                            $output['status'] = 500 ;
                            $output['msg'] = 'error.betPointsGreaterNull' ;
                            $output['result'] = "<i class='fa fa-stop-circle'></i>" ;
                        } else {
                            $output['debug'][__LINE__] = "bet updated" ;
                            $betRepository->update($bet) ;
                            $persistenceManager->persistAll() ;
                            $output['bet'] = $bet->getUid() ;
                            $output['status'] = 200 ;
                            $output['msg'] = 'status.betUpdated' ;
                            $output['result'] = $output['input']['goal1'] . ":" . $output['input']['goal2'];
                        }
                    } else {
                        $output['debug'][__LINE__] = "new bet " ;

                        /** @var Bet $bet */
                        $bet = $objectManager->get('JVE\\Worldcup2\\Domain\\Model\\Bet');
                        $bet->setFeuser( $feuser );
                        $bet->setGame( $game );
                        $bet->setPid( $pid );
                        $bet->setGoalsteam1( $output['input']['goal1']);
                        $bet->setGoalsteam2( $output['input']['goal2']);
                        if( $bet->getPoints() > 0) {
                            $output['debug'][__LINE__] = "bet too late" ;
                            // This may not happen: A bet may giv only points when not running.
                            $output['status'] = 500 ;
                            $output['msg'] = 'error.betPointsGreaterNull' ;
                            $output['result'] = "<i class='fa fa-stop-circle'></i>" ;
                        } else {
                            $output['debug'][__LINE__] = "bet added" ;
                            $betRepository->add($bet) ;
                            $persistenceManager->persistAll() ;

                            $output['bet'] = $bet->getUid() ;
                            $output['status'] = 200 ;
                            $output['msg'] = 'status.betInserted' ;
                        }
                    }
                } else {
                    $output['status'] = 401 ;
                    $output['msg'] = "error.toolate" ;
                    $output['result'] = "<i class='fa fa-stop-circle'></i>" ;
                }
            } else {
                    $output['status'] = 401 ;
                    $output['msg'] = "error.nogame" ;
                $output['result'] = "<i class='fa fa-stop-circle'></i>" ;
            }




        } else {
            $output['status'] = 401 ;
            $output['result'] = "<i class='fa fa-stop-circle'></i>" ;
            $output['msg'] = "error.nouser" ;
        }

       // unset($output['debug']) ;
        return $output ;
    }
    private function cleanInput($var , $max = 99999 ) {
        $var = intval($var) ;
        $var = max ( $var ,0 ) ;
        $var = min ( $var , $max ) ;
        return $var ;
    }




}
