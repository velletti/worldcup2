<?php
declare(strict_types=1);

namespace JVE\Worldcup2\Domain\Model;


/**
 * This file is part of the "Place WM and EM Bets" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Jörg Velletti <typo3@velletti.de>, Allplan GmbH
 * Team
 */
class Team extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $name = '';

    /**
     * flag
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $flag = '';

    /**
     * shortcutfifa
     * 
     * @var string
     */
    protected $shortcutfifa = '';

    /**
     * Returns the name
     * 
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     * 
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the flag
     * 
     * @return string $flag
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Sets the flag
     * 
     * @param string $flag
     * @return void
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    }

    /**
     * Returns the shortcutfifa
     * 
     * @return string $shortcutfifa
     */
    public function getShortcutfifa()
    {
        return $this->shortcutfifa;
    }

    /**
     * Sets the shortcutfifa
     * 
     * @param string $shortcutfifa
     * @return void
     */
    public function setShortcutfifa($shortcutfifa)
    {
        $this->shortcutfifa = $shortcutfifa;
    }
}
