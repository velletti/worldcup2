<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Domain\Repository;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "Place WM and EM Bets" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Jörg Velletti <typo3@velletti.de>, Allplan GmbH
 * The repository for Games
 */
class GameRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'playtime' => QueryInterface::ORDER_ASCENDING ,
        'remark' => QueryInterface::ORDER_DESCENDING
    );



    public function findByDate( int $limit=0 ) {
        $query = $this->createQuery() ;
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query->getQuerySettings()->setRespectSysLanguage(FALSE);

        $constraints = [] ;
        $now = new \DateTime("now") ;
        $constraints[] = $query->greaterThanOrEqual('playtime' , $now ) ;
        if( count($constraints) > 0 ) {
            $query->matching($query->logicalAnd($constraints));
        }
        if( $limit > 0 ) {
            $query->setLimit($limit) ;
        }

        return $query->execute() ;
    }

    public function findLastGame( $notUid=0 ) {
        $query = $this->createQuery() ;
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query->getQuerySettings()->setRespectSysLanguage(FALSE);
        $query->setOrderings( [ 'playtime' => QueryInterface::ORDER_DESCENDING]) ;

        $constraints = [] ;
        $now = new \DateTime("now") ;
        $constraints[] = $query->lessThanOrEqual('playtime' , $now->modify("-1 minute") ) ;
        $constraints[] = $query->equals('finished' , 1 ) ;

        if( $notUid > 0 ) {
            $constraints[] = $query->logicalOr( [$query->lessThan('uid' , $notUid )
                                              ,  $query->greaterThan('uid' , $notUid ) ] ) ;
        }
        $query->matching($query->logicalAnd($constraints));

        $query->setLimit(1) ;
         //    $this->debugQuery($query) ;
        return $query->execute() ;
    }

    public function findNextGame( $notUid=0 ) {
        $query = $this->createQuery() ;
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query->getQuerySettings()->setRespectSysLanguage(FALSE);
        $query->setOrderings( [ 'playtime' => QueryInterface::ORDER_ASCENDING]) ;

        $constraints = [] ;
        $constraints[] = $query->equals('finished' , 0 ) ;
        $now = new \DateTime("now") ;
        $now2 = new \DateTime("now") ;
      //  $constraints[] = $query->greaterThanOrEqual('playtime' , $now->modify("-60 minute") ) ;
      //  $constraints[] = $query->lessThanOrEqual('playtime' , $now2->modify("+120 minute") ) ;

        if( $notUid > 0 ) {
            $constraints[] = $query->logicalOr( [$query->lessThan('uid' , $notUid )
                ,  $query->greaterThan('uid' , $notUid ) ] ) ;
        }
        $query->matching($query->logicalAnd($constraints));

        $query->setLimit(1) ;
        return $query->execute() ;
    }

    public function findAll( int $limit=0 ) {
        $query = $this->createQuery() ;
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query->getQuerySettings()->setRespectSysLanguage(FALSE);

        $constraints = [] ;
        if( count($constraints) > 0 ) {
            $query->matching($query->logicalAnd($constraints));
        }
        if( $limit > 0 ) {
            $query->setLimit($limit) ;
        }
        return $query->execute() ;
    }

    public function getGoalsCount( $pid ) {

        /** @var Connection $connection */
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tx_worldcup2_domain_model_game');

        $queryBuilder = $connection->createQueryBuilder();
        $query = $queryBuilder
            ->selectLiteral('SUM(goalsteam1) AS goalsteam1' , 'SUM(goalsteam2) as goalsteam2')
            ->from('tx_worldcup2_domain_model_game')
            ->where( "finished = 1 ")
            ->andWhere( "pid= " . $pid ) ;

        return $query->execute()->fetchAllAssociative();
    }


}
