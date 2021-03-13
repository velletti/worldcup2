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
class GameRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'playtime' => QueryInterface::ORDER_ASCENDING
    );

    public function findByDate( $limit=0 ) {
        $query = $this->createQuery() ;
        if( $limit > 0 ) {
            $query->setLimit($limit) ;
        }
        return $query->execute() ;
    }
}
