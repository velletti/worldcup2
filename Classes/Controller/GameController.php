<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Controller;


use Allplan\NemConnections\Utility\MigrationUtility;
use Allplan\NemFeuser\Domain\Repository\UserRepository;
use JVE\Worldcup2\Domain\Model\Bet;
use JVE\Worldcup2\Domain\Model\Game;
use JVE\Worldcup2\Domain\Repository\GameRepository;
use JVE\Worldcup2\Domain\Repository\BetRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
     * betRepository
     *
     * @var BetRepository
     */
    protected $betRepository = null;

    /**
     * @var int
     */
    protected $betPid = 0 ;

    /**
     * @var array|null
     */
    protected $currentUser = null ;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function injectUserRepository(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param GameRepository $gameRepository
     */
    public function injectGameRepository(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param BetRepository $betRepository
     */
    public function injectBetRepository(BetRepository $betRepository)
    {
        $this->betRepository = $betRepository;
    }

    public function initializeAction()
    {
        parent::initializeAction();

        $context = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Context\Context::class) ;
        $languageAspect = $context->getAspect('language') ;
        if ( $context->getPropertyFromAspect('frontend.user', "isLoggedIn") ) {
            $this->currentUser['id'] = $context->getPropertyFromAspect('frontend.user', "id") ;
            $this->currentUser['username'] = $context->getPropertyFromAspect('frontend.user', "username") ;
            $this->currentUser['groupIds'] = $context->getPropertyFromAspect('frontend.user', "groupIds") ;
        } else {
            $this->currentUser['id'] = 0 ;
            $this->currentUser['username'] = '';
            $this->currentUser['groupIds'] = '';
        }

        if (GeneralUtility::_GP("L") && intval(GeneralUtility::_GP("L") > 0)) {
            $this->settings["sys_langauge_uid"] = intval(GeneralUtility::_GP("L"));
        } else {
            $this->settings["sys_langauge_uid"] = $languageAspect->getId() ;
        }
        if( (int)$this->settings['flexform']['maxGames'] > 0 ) {
            $this->settings['maxGames'] = $this->settings['flexform']['maxGames'] ;
        }



    }

    /**
     * action next
     *
     * @return string|object|null|void
     */
    public function nextAction()
    {
        $pid = intval($this->settings['pids']['storagePID']) > 0 ? intval($this->settings['pids']['storagePID']) : $GLOBALS['TSFE']->id;
        $this->betPid = intval($this->settings['pids']['userbetPID']) ;
        if( $this->betPid < 1 ) {
            $this->betPid = $pid ;
        }
       // var_dump($this->settings);
        $this->enhanceGames($this->gameRepository->findByDate( (int)$this->settings['maxGames']) ) ;
        $this->view->assign("currentUser" , $this->currentUser ) ;
    }

    /**
     * action listgroups
     *
     * @return string|object|null|void
     */
    public function listgroupsAction()
    {
        $pid = intval($this->settings['pids']['storagePID']) > 0 ? intval($this->settings['pids']['storagePID']) : $GLOBALS['TSFE']->id;
        $this->betPid = intval($this->settings['pids']['userbetPID']) ;
        if( $this->betPid < 1 ) {
            $this->betPid = $pid ;
        }

        $this->enhanceGames( $this->gameRepository->findAll()) ;
        $this->view->assign("currentUser" , $this->currentUser ) ;
        $this->view->assign("betPid" , $this->betPid ) ;
        $stepindicators = $this->getNotLoginStepIndicator() ;
        if( $this->currentUser ) {
            $stepindicators = $this->getPlayStepIndicator() ;
        } else {
            $stepindicators = $this->getNotLoginStepIndicator() ;
        }

        $this->view->assign("stepindicators" , $stepindicators ) ;
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
        $pid = intval($this->settings['pids']['storagePID']) > 0 ? intval($this->settings['pids']['storagePID']) : $GLOBALS['TSFE']->id;
        $this->betPid = intval($this->settings['pids']['userbetPID']) ;
        $this->view->assign("userbetPID" , $this->betPid  ) ;
        $this->view->assign("gamesPID" , $pid  ) ;

        if( $this->betPid < 1 ) {
            $this->betPid = $pid ;
        }
        // ToDo :  REINTEGRATE BETTEAM selector
        $betTeam = "WINNER-" ;
        if($this->request->hasArgument("filter")) {
            $betTeam = $this->request->getArgument("filter") ;
            $this->view->assign("filter" , $betTeam ) ;
        }

        $start = 0 ;
        if($this->request->hasArgument("start") ) {
            $start = intval ($this->request->getArgument("start") ) ;
        }
        $playersCountSql = $this->betRepository->getPlayersCountSql($this->betPid ) ;

        $goals = $this->gameRepository->getGoalsCount($pid) ;
        $goalsTotal = 0 ;
        if( $goals) {
            $this->view->assign("goalsteam1" , $goals[0]['goalsteam1'] ) ;
            $this->view->assign("goalsteam2" , $goals[0]['goalsteam2'] ) ;
            $this->view->assign("goalsTotal" , $goals[0]['goalsteam1'] + $goals[0]['goalsteam2'] ) ;
            $goalsTotal = $goals[0]['goalsteam1'] + $goals[0]['goalsteam2'] ;
        }

        $rankingSelectSql = $this->betRepository->getRankingSelectSql($this->betPid , $goalsTotal ) ;
        $rankingFilterSql = $this->betRepository->getRankingFilterSql($betTeam) ;
        $rankingEndSql =   $this->betRepository->getRankingEndSql($pid) ;

        $rankingSql = $rankingSelectSql . $rankingFilterSql . $rankingEndSql . " LIMIT " . $start . ", 50 " ;
        $this->view->assign("debugSQL" , $rankingSql ) ;

        /** @var \TYPO3\CMS\Core\Database\ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance( "TYPO3\\CMS\\Core\\Database\\ConnectionPool");
        /** @var \TYPO3\CMS\Core\Database\Connection $connection */
        $connection = $connectionPool->getConnectionForTable('tx_worldcup2_domain_model_bet');

        $this->view->assign("playerTotal" , $connection->executeQuery( $playersCountSql )->rowCount() ) ;
        /*
         echo $rankingSql . "<hr>" ;
         var_dump($connection->executeQuery( $rankingSql )->fetchAllAssociative());
        die;
        */
        $this->enhanceResult(  $connection->executeQuery( $rankingSql )->fetchAllAssociative() , $start , $goalsTotal) ;

        if( $this->currentUser['id'] ) {
            $rankingSqlUser = $rankingSelectSql . " AND u.uid= " . $this->currentUser['id'] . " " . $rankingEndSql ;
            $this->view->assign("currentUserResult" , $connection->executeQuery($rankingSqlUser . "")->fetchAssociative() ) ;
        }
        $this->view->assign("currentUser" , $this->currentUser ) ;


        if( $this->currentUser ) {
            $stepindicators = $this->getRankingStepIndicator() ;
        } else {
            $stepindicators = $this->getNotLoginStepIndicator() ;
        }

        $this->view->assign("stepindicators" , $stepindicators ) ;
        $this->view->assign("lastUpdated" , date("d.m. H:i") ) ;

    }
    /**
     * action AGBs (mainly used to show the step navigation
     *
     * @return string|object|null|void
     */
    public function showagbAction()
    {

        if( $this->currentUser ) {
            $stepindicators = $this->getAgbStepIndicator() ;
        } else {
            $stepindicators = $this->getNotLoginStepIndicator() ;
        }

        $this->view->assign("stepindicators" , $stepindicators ) ;

    }

    /**
     * action showgroup
     *
     * @return string|object|null|void
     */
    public function showgroupAction()
    {
    }


    /**** *************************************** Helper ***************************************  */

    private function getAgbStepIndicator() {
        $stepindicators[] = $this->getStepIndicator( 1 ,"stepdone" , true , false , "Login" ,
            0) ;
        $stepindicators[] = $this->getStepIndicator( 2 ,"stepactive" , false , false , "Rules" ,
            $this->settings['pids']['rules'] ) ;
        $stepindicators[] = $this->getStepIndicator( 3 ,"stepClickable" , false , true , "Play" ,
            $this->settings['pids']['listgames'] ) ;
        $stepindicators[] = $this->getStepIndicator( 4 ,"stepClickable" , false , true , "Win" ,
            $this->settings['pids']['ranking'] ) ;
        return $stepindicators ;
    }

    private function getNotLoginStepIndicator() {
        $stepindicators[] = $this->getStepIndicator( 1 ,"stepactive" , false , false , "Login" ,
            $this->settings['pids']['login']) ;
        $stepindicators[] = $this->getStepIndicator( 2 ,"stepClickable" , false , true , "Rules" ,
            $this->settings['pids']['rules'] ) ;
        $stepindicators[] = $this->getStepIndicator( 3 ,"stepinactive" , false , true , "Play" ,
            0 ) ;
        $stepindicators[] = $this->getStepIndicator( 4 ,"stepinactive" , false , true , "Win" ,
            0 ) ;
        return $stepindicators ;
    }
    private function getPlayStepIndicator() {
        $stepindicators[] = $this->getStepIndicator( 1 ,"stepdone" , true , false , "Login" ,
            0) ;
        $stepindicators[] = $this->getStepIndicator( 2 ,"stepClickable" , true , false , "Rules" ,
            $this->settings['pids']['rules'] ) ;
        $stepindicators[] = $this->getStepIndicator( 3 ,"stepactive" , false , false , "Play" ,
            $this->settings['pids']['listgames'] ) ;
        $stepindicators[] = $this->getStepIndicator( 4 ,"stepClickable" , false , true , "Win" ,
            $this->settings['pids']['ranking'] ) ;
        return $stepindicators ;
    }

    private function getRankingStepIndicator() {
        $stepindicators[] = $this->getStepIndicator( 1 ,"stepdone" , true , false , "Login" ,
            0 ) ;
        $stepindicators[] = $this->getStepIndicator( 2 ,"stepClickable" , true , false , "Rules" ,
            $this->settings['pids']['rules'] ) ;
        $stepindicators[] = $this->getStepIndicator( 3 ,"stepClickable" , true , false , "Play" ,
            $this->settings['pids']['listgames'] ) ;
        $stepindicators[] = $this->getStepIndicator( 4 ,"stepactive" , false , false , "Win" ,
            $this->settings['pids']['ranking'] ) ;
        return $stepindicators ;
    }


    private function getStepIndicator( $index , $cssClass , $before , $after , $name , $pid ) {
        return  [ "index" => $index ,
            "linkBefore" => $before ,
            "linkAfter" => $before ,
            "cssClass" => $cssClass ,
            "name" => $name ,
            "style" => "width: 26.6%" ,
            "pid"   => $pid
        ] ;

    }

    /**
     * @param Game|null $games
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    private function enhanceGames($games=null  ) {
        if($this->request->hasArgument("user")) {
            $user = (int)$this->request->getArgument("user") ;
            $requestedUser = $this->userRepository->findByUid($user) ;
            $this->view->assign("requestedUser" , $requestedUser ) ;
        } else {
            $user = $this->currentUser['id'] ;
            $this->view->assign("requestedUser" , false ) ;
        }
        $enhancedGames= [] ;
        if( $games) {
            $isNextGameSet = false ;
            $now = new \DateTime("now") ;

            /** @var Game $game */
            foreach ($games as $game) {
                /** @var Bet $bet */
                $bet = $this->betRepository->findbyGameAndUser($game->getUid() , $user , $this->betPid ) ;
                $game->setUserbet($bet);
                if( $game->getPlaytime() > $now && !$isNextGameSet ) {
                    $isNextGameSet = true;
                    $game->setNextGame(true);
                }
                $enhancedGames[] = $game ;
            }
        }
        $this->view->assign("games" , $enhancedGames ) ;
    }

    /**
     * @param array|null $rankings
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    private function enhanceResult( $rankings=null , $start=0 , $goalsTotal=0) {
        if($this->request->hasArgument("user")) {
            $user = (int)$this->request->getArgument("user") ;
            $this->view->assign("requestedUser" , $user ) ;
        } else {
            $user = $this->currentUser['id'] ;
            $this->view->assign("requestedUser" , false ) ;
        }



        $secondGame = false ;
        /** @var Game $lastGame */
        $lastGame = $this->gameRepository->findLastGame()->getFirst() ;


        if( $rankings && count ($rankings) > 0  ) {

            $lastGameText = "" ;
            $secondGameText = "" ;
            if (  $lastGame ) {
                $lastGameText =   $lastGame->getTeam1()->getName() . ":" . $lastGame->getTeam2()->getName()
                    . " (" . $lastGame->getGoalsteam1() . ": " . $lastGame->getGoalsteam2() . ")";
                /** @var Game $secondGame */
                $secondGame = $this->gameRepository->findLastGame($lastGame->getUid())->getFirst() ;

                $this->view->assign("lastGame" ,  $lastGame ) ;
                $this->view->assign("secondGame" ,  $secondGame ) ;
            }
            if (  $secondGame ) {
                $secondGameText = $secondGame->getTeam1()->getName() . ":" . $secondGame->getTeam2()->getName()
                    . " (" . $secondGame->getGoalsteam1() . ": " . $secondGame->getGoalsteam2() . ")";
            }
            $this->view->assign("lastGameText" ,  $lastGameText ) ;
            $this->view->assign("secondGameText" ,  $secondGameText ) ;

            /** @var Game $nextGame */
            $nextGame = $this->gameRepository->findNextGame()->getFirst() ;
            $nextOtherGame = false ;

            if ($nextGame  ) {
                $this->view->assign("nextGame" ,  $nextGame ) ;

                /** @var Game $nextOtherGame */
                $nextOtherGame = $this->gameRepository->findNextGame($nextGame->getUid())->getFirst( ) ;
                if ($nextOtherGame  ) {
                    $this->view->assign("nextOtherGame" ,  $nextOtherGame ) ;
                }
            } else {
                $this->view->assign("nextGame" ,  false ) ;
                $this->view->assign("nextOtherGame" ,  false ) ;
            }


            $this->view->assign("start" ,  $start ) ;

            $start++ ;
            $this->view->assign("start" ,  $start ) ;
            foreach ($rankings as $key => $row) {
                $rankings[$key]['pos'] = $start++ ;
                $rankings[$key]['flag'] = strtolower(  $rankings[$key]['flag'] ) ;

                $domain = explode('@', $rankings[$key]['email'] ) ;
                $domain = explode('.', $domain[1] ) ;
                switch ($domain[0]) {
                    case "allplan-dev":
                    case "allplan-infra":
                    case "precast-software":
                        $rankings[$key]['domain'] =  "allplan" ;
                        break ;
                    case "dds-cad":
                        $rankings[$key]['domain'] =  "dds" ;
                        break ;
                    case "redschift3d":
                    case "redgiant":
                        $rankings[$key]['domain'] =  "maxon" ;
                        break ;
                    case "dsndata":
                        $rankings[$key]['domain'] =  "sds2" ;
                        break ;
                    case "dexma":
                        $rankings[$key]['domain'] =  "spacewell" ;
                        break ;
                    default:
                        $rankings[$key]['domain'] =  $domain[0] ;
                }
                $rankings[$key]['userType'] = "Other" ;
                $rankings[$key]['userFilter'] = false ;
                if ($rankings[$key]['usericon'] == "Group_32_student" ) {
                    $rankings[$key]['userType'] = "Student" ;
                    $rankings[$key]['userFilter'] = "USERTYP-32" ;
                }
                if ($rankings[$key]['usericon'] == "Group_17_nemdirect" ) {
                    $rankings[$key]['userType'] = "PartnerMA" ;
                    $rankings[$key]['userFilter'] = "USERTYP-7" ;
                }
                if ($rankings[$key]['usericon'] == "Group_3_SP"  ) {
                    $rankings[$key]['userType'] = "S+Customer" ;
                    $rankings[$key]['userFilter'] = "USERTYP-3" ;
                }
                if ($rankings[$key]['usericon'] == "Group_11_Lic" ) {
                    $rankings[$key]['userType'] = "Customer" ;
                    $rankings[$key]['userFilter'] = "USERTYP-11" ;
                }
                if ($rankings[$key]['tx_mmforum_post_count'] > 49 ) {
                    $rankings[$key]['userType'] = "ForumUser" ;
                    $rankings[$key]['userFilter'] = "FORUM-U" ;
                }

                if ($rankings[$key]['tx_mmforum_helpful_count_season'] > 9 ) {
                    $rankings[$key]['userType'] = "ForumHelper" ;
                    $rankings[$key]['userFilter'] = "FORUM-H" ;
                }


                if (  $lastGame ) {
                    /** @var Bet $bet */
                    $bet = $this->betRepository->findByGameAndUser($lastGame->getUid() , $row['uid'] , $this->betPid ) ;
                    $rankings[$key]['lastBet']['game'] = $lastGameText  ;
                    if ( $bet ) {
                        $rankings[$key]['lastBet']['points'] = $bet->getPoints() ;
                        $rankings[$key]['lastBet']['goalsTeam1'] = $bet->getGoalsteam1() ;
                        $rankings[$key]['lastBet']['goalsTeam2'] = $bet->getGoalsteam2() ;
                    }

                } else {
                    $rankings[$key]['lastBet'] = false ;
                }
                if (  $secondGame ) {
                    /** @var Bet $bet */
                    $bet = $this->betRepository->findByGameAndUser($secondGame->getUid() , $row['uid'] , $this->betPid ) ;
                    $rankings[$key]['secondBet']['game'] = $secondGameText  ;
                    if ( $bet ) {
                        $rankings[$key]['secondBet']['points'] = $bet->getPoints() ;
                        $rankings[$key]['secondBet']['goalsTeam1'] = $bet->getGoalsteam1() ;
                        $rankings[$key]['secondBet']['goalsTeam2'] = $bet->getGoalsteam2() ;
                    }

                } else {
                    $rankings[$key]['secondBet'] = false ;
                }

                if (  $nextGame ) {
                    /** @var Bet $bet */
                    $bet = $this->betRepository->findByGameAndUser($nextGame->getUid() , $row['uid'] , $this->betPid ) ;
                    if ( $bet ) {
                        if( $nextGame->isGameStartingSoon() ) {
                            $rankings[$key]['nextBet']['game'] = $nextGame->getUid()  ;
                            $rankings[$key]['nextBet']['goalsTeam1'] = $bet->getGoalsteam1() ;
                            $rankings[$key]['nextBet']['goalsTeam2'] = $bet->getGoalsteam2() ;
                        } else {
                            $rankings[$key]['nextBet']['goalsTeam1'] = "??" ;
                            $rankings[$key]['nextBet']['goalsTeam2'] = "??" ;
                        }
                    } else {
                        $rankings[$key]['nextBet']['goalsTeam1'] = "" ;
                        $rankings[$key]['nextBet']['goalsTeam2'] = "" ;
                    }

                } else {
                    $rankings[$key]['nextBet'] = false ;
                }

                if (  $nextOtherGame ) {
                    /** @var Bet $bet */
                    $bet = $this->betRepository->findByGameAndUser($nextOtherGame->getUid() , $row['uid'] , $this->betPid ) ;
                    if ( $bet ) {
                        if( $nextOtherGame->isGameStartingSoon() ) {
                            $rankings[$key]['nextOtherBet']['game'] = $nextOtherGame->getUid();
                            $rankings[$key]['nextOtherBet']['goalsTeam1'] = $bet->getGoalsteam1();
                            $rankings[$key]['nextOtherBet']['goalsTeam2'] = $bet->getGoalsteam2();
                        } else {
                            $rankings[$key]['nextOtherBet']['goalsTeam1'] = "??" ;
                            $rankings[$key]['nextOtherBet']['goalsTeam2'] = "??" ;
                        }
                    } else {
                        $rankings[$key]['nextOtherBet']['goalsTeam1'] = "" ;
                        $rankings[$key]['nextOtherBet']['goalsTeam2'] = "" ;
                    }

                } else {
                    $rankings[$key]['nextOtherBet'] = false ;
                }
                $goalsCount = $this->betRepository->getGoalsCount($row['uid'] , $this->betPid) ;
                if($goalsCount ) {
                    $rankings[$key]['betcount'] = $goalsCount[0]['betcount'] ;
                    $rankings[$key]['betsteam1'] = $goalsCount[0]['betsteam1'] ;
                    $rankings[$key]['betsteam2'] = $goalsCount[0]['betsteam2'] ;
                    $rankings[$key]['betstotal'] = ( intval( $goalsCount[0]['betsteam1'])  +  intval($goalsCount[0]['betsteam2']) ) ;
                    $rankings[$key]['diff'] = abs( $goalsTotal
                                                      - ( intval( $goalsCount[0]['betsteam1'])  +  intval($goalsCount[0]['betsteam2']) ) );

                }
            }
        }
        $this->view->assign("end" , ( $start - 1 ) ) ;
        $this->view->assign("rankings" , $rankings ) ;

    }
}
