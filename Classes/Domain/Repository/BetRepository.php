<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Domain\Repository;


/**
 * This file is part of the "Place WM and EM Bets" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Jörg Velletti <typo3@velletti.de>, Allplan GmbH
 * The repository for Bets
 */
class BetRepository extends BaseRepository
{
    /**
     * @param $gameUid
     * @param $userUid
     * @return mixed
     */
    public function findByGameAndUser( $gameUid , $userUid) {
        $query = $this->createQuery() ;
        $query->getQuerySettings()->setRespectStoragePage(FALSE);

        $constraints[] = $query->equals( "game" , $gameUid ) ;
        $constraints[] = $query->equals( "feuser" , $userUid ) ;

        $query->matching($query->logicalAnd($constraints));
        $query->setLimit(1) ;
        // $this->debugQuery($query) ;

        return $query->execute()->getFirst()  ;
    }

    /**
     * @param $gameUid
     * @param int $limit
     * @return mixed
     */
    public function findFinished( $limit = 20 ) {
        $query = $this->createQuery() ;
        $query->getQuerySettings()->setRespectStoragePage(FALSE);

        $constraints = [] ;
        $now = new \DateTime("now") ;
        $constraints[] = $query->lessThanOrEqual('game.playtime' , $now ) ;
        $constraints[] = $query->equals('game.finished' , 1 ) ;
        if( count($constraints) > 0 ) {
            $query->matching($query->logicalAnd($constraints));
        }
        if( $limit > 0 ) {
            $query->setLimit($limit) ;
        }
        return $query->execute() ;
    }

    public function getRankingSelectSql( $pid ) {

        return "SELECT	u.username,
						u.tx_nem_lastname,
						CASE when FIND_IN_SET( 7, u.usergroup )
							then
						  		'Group_17_nemdirect'
						  	else
                                CASE when FIND_IN_SET( 44, u.usergroup )
                                then
                                    'Group_17_nemdirect'
                                else
                                    CASE when FIND_IN_SET( 3, u.usergroup )
                                    then
                                        'Group_3_SP'
                                    else
                                        CASE when FIND_IN_SET( 11, u.usergroup )
                                        then
                                            'Group_11_Lic'
                                        else

                                            CASE when FIND_IN_SET( 32, u.usergroup )
                                            then
                                                'Group_32_student'
                                            else
                                                CASE when FIND_IN_SET( 33, u.usergroup )
                                                then
                                                    'Group_32_student'
                                                else
                                                    'Group_10_User'
                                                end
                                            end
                                        end
                                    end
                                end
						  	end 'usericon'
						,

						u.uid,
						u.tx_nem_country as flag,

						u.tx_nem_comments,
                        SUM( b.goalsteam1 ) as BetGoalsTotal1 ,
                        SUM( b.goalsteam2 ) as BetGoalsTotal2 ,

          				SUM(CASE
									WHEN	g.goalsteam2 IS NULL OR  g.goalsteam1 IS NULL THEN 0
									WHEN	b.goalsteam1 = g.goalsteam1 AND b.goalsteam2 = g.goalsteam2	THEN 3
									WHEN	b.goalsteam1 - b.goalsteam2 = g.goalsteam1 - g.goalsteam2 THEN 2
									WHEN	(CASE	WHEN b.goalsteam1 > b.goalsteam2 THEN 1
													WHEN b.goalsteam1 < b.goalsteam2 THEN 2
													ELSE 0
													END) =
											(CASE	WHEN g.goalsteam1 > g.goalsteam2 THEN 1
													WHEN g.goalsteam1 < g.goalsteam2 THEN 2
													ELSE 0 END)	THEN 1
								ELSE 0
						END) AS points

				FROM	(tx_worldcup2_domain_model_bet b INNER JOIN fe_users u
				ON		b.feuser = u.uid
				AND     b.pid = " . $pid . "
				AND		u.deleted = 0 " ;
    }

    public function getRankingFilterSql( $betteam ) {
        if ( $betteam <> '' && is_object($GLOBALS['TSFE']->fe_user) && is_array( $GLOBALS['TSFE']->fe_user->user )) {
            $filter = substr( $betteam , 0 , 7) ;
            $subfilter = substr( $betteam , 8 , 10) ;

            switch ($filter) {
                case 'KD-NUM-':

                    // is nemetschek ONE user Group 44 then By Company means by Email Domain !
                    if ( in_array( "44" , explode(  "," , $GLOBALS['TSFE']->fe_user->user['usergroup'] ))){
                        $mailDomain = explode("@" , $GLOBALS['TSFE']->fe_user->user['email'] ) ;
                       return " AND u.email like '%@" .  $mailDomain[1] ."'" ;

                    } else {
                        // für kunden
                       return " AND u.tx_nem_cnum = '" .  $GLOBALS['TSFE']->fe_user->user['tx_nem_cnum'] ."'" ;

                    }

                    break;

                case 'COUNTRY':
                    if ( $subfilter == "") {
                       return " AND u.tx_nem_country = '" .  $GLOBALS['TSFE']->fe_user->user['tx_nem_country'] ."'" ;
                    } else {
                       return " AND u.tx_nem_country = '" .  substr( $subfilter , 0 , 2 )."'" ;
                    }

                    // j.v.:
                    break;
                case 'USERTYP':
                    if ( $subfilter == "") {
                        $usergroup_arr = explode( "," , $GLOBALS['TSFE']->fe_user->user['usergroup'] ) ;

                        if ( in_array("10" , $usergroup_arr) || in_array("11" , $usergroup_arr) || in_array("13" , $usergroup_arr)) {
                            return " AND ( FIND_IN_SET( 10 , u.usergroup ) OR FIND_IN_SET(11, u.usergroup ) OR FIND_IN_SET(13, u.usergroup ) )" ;
                        }
                        if ( in_array("32" , $usergroup_arr) || in_array("33" , $usergroup_arr)) {
                            return " AND ( FIND_IN_SET( 32 , u.usergroup ) OR FIND_IN_SET(33, u.usergroup ) ) " ;
                        }
                        if ( in_array("3" , $usergroup_arr)) {
                            return " AND ( FIND_IN_SET(3, u.usergroup ) OR FIND_IN_SET(14, u.usergroup ) )" ;
                        }
                        if ( in_array("7" , $usergroup_arr)) {
                            return " AND ( FIND_IN_SET(7, u.usergroup ) OR FIND_IN_SET(17, u.usergroup ) )" ;
                        }
                        if ( in_array("44" , $usergroup_arr)) {
                            return " AND ( FIND_IN_SET(44, u.usergroup ) )" ;
                        }

                    } else {
                        if ( $subfilter == 32) {
                           return " AND FIND_IN_SET(32, u.usergroup ) AND NOT FIND_IN_SET( 3 , u.usergroup ) AND NOT FIND_IN_SET( 7, u.usergroup ) " ;
                        } else if ( $subfilter == 10) {
                           return " AND FIND_IN_SET(10, u.usergroup ) AND NOT FIND_IN_SET( 31 , u.usergroup )  AND NOT FIND_IN_SET( 32 , u.usergroup ) AND NOT FIND_IN_SET( 33, u.usergroup ) " ;
                        } else {
                           return " AND FIND_IN_SET(" .  intval($subfilter ) .", u.usergroup )" ;
                        }


                    }

                    break;
                case 'USR-LNG':
                    if ( $subfilter == "") {
                       return " AND u.tx_nem_language = '" .  $GLOBALS['TSFE']->fe_user->user['tx_nem_language'] ."'" ;
                    } else {
                       return " AND u.tx_nem_language = '" .  substr($subfilter , 0 , 3 ) ."'" ;
                    }
                    break;
                case 'FORUM-U':
                   return " AND ( u.tx_mmforum_post_count  + tx_mmforum_topic_count > 49 ) " ;
                    break;
                case 'WINNER-':
                   return " " ;
                    break;

                default:
                   return " AND     u.tx_nem_comments = '" .  $betteam ."'" ;
                    break;

            }

        }
        return '' ;
    }
    public function getRankingEndSql($pid) {
        return  " AND		b.deleted = 0
				AND		b.goalsteam1 <> ''
				AND		b.goalsteam2 <> '') LEFT OUTER JOIN tx_worldcup2_domain_model_game g
				ON		b.game = g.uid
				AND		g.deleted = 0
				AND     g.pid = " . $pid . "
				AND		g.playtime < ".time()."
				AND		g.goalsteam1 <> ''
				AND		g.goalsteam2 <> ''
				AND     g.finished = 1
				GROUP BY	u.username,
							u.uid
				ORDER BY	points DESC";
    }

}
