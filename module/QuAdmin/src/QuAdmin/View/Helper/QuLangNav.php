<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class QuLangNav extends AbstractHelper
{
    /**
     * @var
     */
    protected $QuLangNav;

    /**
     * @param $QuLangNav
     */
    public function __construct($QuLangNav)
    {
        $this->QuLangNav = $QuLangNav;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        return $this->QuLangNav->getLangNav();
    }
}