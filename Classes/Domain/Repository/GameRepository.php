<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;

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
        $constraints[] = $query->lessThanOrEqual('playtime' , $now ) ;

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


}
