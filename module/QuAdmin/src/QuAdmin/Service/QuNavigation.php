<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;


class QuNavigation extends DefaultNavigationFactory
{
    protected $pages;

    /**
     * @return string
     */
    protected function getName()
    {
        return 'QuNavigation';
    }
}
