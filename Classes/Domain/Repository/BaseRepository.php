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
class BaseRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    public function debugQuery($query) {
        // new way to debug typo3 db queries
        $queryParser = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
        $querystr = $queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL() ;
        echo $querystr ;
        echo "<hr>" ;
        $queryParams = array_reverse ( $queryParser->convertQueryToDoctrineQueryBuilder($query)->getParameters()) ;
        var_dump($queryParams);
        echo "<hr>" ;

        foreach ($queryParams as $key => $value ) {
            $search[] = ":" . $key ;
            $replace[] = "'$value'" ;

        }
        echo str_replace( $search , $replace , $querystr ) ;

        die;
    }
}
