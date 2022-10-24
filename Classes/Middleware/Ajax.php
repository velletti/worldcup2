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
use TYPO3\CMS\Core\Database\ConnectionPool;
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
                ->withHeader('content-type', 'application/json; charset=utf-8')
                ->withHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                ->withHeader('Pragma', 'public')
                ->withHeader('Expires', '0')

                ->withBody($body)
                // statu must be 200 for jQuery. Errors have to be handle in Javascript
          //      ->withStatus($output['status'])
                ;

        }
        return $handler->handle($request);
    }
    private function handleRequest($_gp) {
        $output['input']['start'] = $this->cleanInput($_gp['ranking']) ;
        $output['input']['game'] = $this->cleanInput($_gp['game']) ;
        $output['input']['goal1'] = $this->cleanInput($_gp['goal1'], 99) ;
        $output['input']['goal2'] = $this->cleanInput($_gp['goal2'], 99 ) ;

        $GLOBALS['TSFE']->initUserGroups();
        $user = $GLOBALS['TSFE']->fe_user->user;


        if( $user ) {

            if ( array_key_exists( 'input' , $output ) && array_key_exists( 'game' , $output['input'] ) &&  $output['input']['game'] > 0 ) {
                $output = $this->storeBet($user , $output , $_gp ) ;
            } else {
                if ( array_key_exists( 'ranking' , $_gp ) ) {
                    $output = $this->userRanking($user , $output , $_gp ) ;
                } else {
                    $output['status'] = 404 ;
                    $output['result'] = "<i class='fa fa-stop-circle'>!</i>" ;
                    $output['msg'] = "error.novalidfunction" ;
                }
            }

        } else {
            $output['status'] = 401 ;
            $output['result'] = "<i class='fa fa-stop-circle'>!</i>" ;
            $output['msg'] = "error.nouser" ;
        }
        unset($output['debug']) ;
        return $output ;
    }
    private function cleanInput($var , $max = 99999 ) {
        $var = intval($var) ;
        $var = max ( $var ,0 ) ;
        $var = min ( $var , $max ) ;
        return $var ;
    }

    public function userRanking( $user, $output , $_gp) {
        $objectManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        /** @var FrontendUserRepository $feuserRepository */
        $feuserRepository = $objectManager->get(\TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository::class);

        /** @var FrontendUser $feuser */
        $feuser = $feuserRepository->findByUid($user['uid'] ) ;

        $output['result']['userid'] = $user['uid'] ;
        $output['result']['username'] = $user['username'] ;
        $output['status'] = 404 ;
        $output['msg'] = "error.workinprogress" ;
        $pid = $this->cleanInput($_gp['pid'])  ;
        $betpid = $this->cleanInput($_gp['userbetpid'])  ;
        $output['input']['pid'] = $pid ;
        $output['input']['userbetpid'] = $betpid ;

        /** @var GameRepository $gameRepository */
        $gameRepository = $objectManager->get(\JVE\Worldcup2\Domain\Repository\GameRepository::class);
        /** @var BetRepository $betRepository */
        $betRepository = $objectManager->get(\JVE\Worldcup2\Domain\Repository\BetRepository::class);

        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance( \TYPO3\CMS\Core\Database\ConnectionPool::class);
        $connection = $connectionPool->getConnectionForTable('tx_worldcup2_domain_model_bet');

        $goals = $gameRepository->getGoalsCount($pid) ;
        $goalsTotal = 0 ;
        if( $goals) {
            $goalsTotal = $goals[0]['goalsteam1'] - $goals[0]['goalsteam2'] ;
        }
        $rankingSelectSql = $betRepository->getRankingSelectSql($betpid , $goalsTotal ) ;
        $rankingEndSql    =   $betRepository->getRankingEndSql($pid) ;

        // $rankingSqlUser = $rankingSelectSql . " AND u.uid= " . $user['uid'] . " " . $rankingEndSql ;
        // $currentUserResult = $connection->executeQuery($rankingSqlUser . "")->fetchAssociative()  ;
        $rankingSqlUser = $rankingSelectSql . $rankingEndSql ;
        $currentUserResults = $connection->executeQuery($rankingSqlUser )   ;

        $output['debug']['pointsSql'] = $rankingSqlUser ;
        $output['result']['position'] = 0 ;
        $output['msg'] = "searching" ;
        $output['status'] = 200 ;

        foreach ( $currentUserResults as $key => $currentUserResult ) {
            if ( $currentUserResult["uid"] == $user['uid'] ) {
                $output['result']['points'] = $currentUserResult['points'] ;
                $output['result']['position'] = $key + 1 ;
                $output['debug']['pointsSql'] = $rankingSqlUser ;
                $output['msg'] = "found" ;
                $output['status'] = 200 ;
            }
        }
        $goalsCount = $betRepository->getGoalsCount($user['uid'] , $betpid) ;
        if($goalsCount ) {
             $output['result']['betcount'] = $goalsCount[0]['betcount'] ;
             $output['result']['betsteam1'] = $goalsCount[0]['betsteam1'] ;
             $output['result']['betsteam2'] = $goalsCount[0]['betsteam2'] ;
             $output['result']['betstotal'] = ( intval( $goalsCount[0]['betsteam1'])  +  intval($goalsCount[0]['betsteam2']) ) ;
        }
        return $output  ;
    }

    public function storeBet( $user, $output , $_gp) {
        $objectManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        /** @var FrontendUserRepository $feuserRepository */
        $feuserRepository = $objectManager->get(\TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository::class);

        /** @var FrontendUser $feuser */
        $feuser = $feuserRepository->findByUid($user['uid'] ) ;

        $output['user'] = $user['uid'] ;
        // store / update bet .

        /** @var GameRepository $gameRepository */
        $gameRepository = $objectManager->get(\JVE\Worldcup2\Domain\Repository\GameRepository::class);
        /** @var BetRepository $betRepository */
        $betRepository = $objectManager->get(\JVE\Worldcup2\Domain\Repository\BetRepository::class);

        /** @var PersistenceManager $persistenceManager */
        $persistenceManager = $objectManager->get(\TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface::class);
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
                        $output['result'] = $bet->getGoalsteam1() . ":" . $bet->getGoalsteam2();
                    }
                } else {
                    $output['debug'][__LINE__] = "new bet " ;

                    /** @var Bet $bet */
                    $bet = $objectManager->get(\JVE\Worldcup2\Domain\Model\Bet::class);
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
                        $output['result'] = "<i class='fa fa-stop-circle'>!</i>" ;
                    } else {
                        $output['debug'][__LINE__] = "bet added" ;
                        $betRepository->add($bet) ;
                        $persistenceManager->persistAll() ;

                        if ( $bet->getUid()  ) {
                            $output['bet'] = $bet->getUid() ;
                            $output['status'] = 200 ;
                            $output['msg'] = 'status.betInserted' ;
                            $output['result'] = $bet->getGoalsteam1() . ":" . $bet->getGoalsteam2();
                        } else {
                            $output['bet'] = 0;
                            $output['status'] = 500 ;
                            $output['msg'] = 'status.unknownError' ;
                            $output['result'] = "<i class='fa fa-stop-circle'>!</i>" ;
                        }

                    }
                }
            } else {
                $output['status'] = 401 ;
                $output['msg'] = "error.toolate" ;
                $output['result'] = "<i class='fa fa-stop-circle'>!</i>" ;
            }
        } else {
            $output['status'] = 401 ;
            $output['msg'] = "error.nogame" ;
            $output['result'] = "<i class='fa fa-stop-circle'>!</i>" ;
        }
        return $output ;
    }




}
