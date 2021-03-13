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
}
