<?php
/**
 * @Author: Cel Ticó Petit
 * @Company: Cencis s.c.p.
 * @Contact: cel@cenics.net
 */

namespace QuWebDemo\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Get css active class menu
 */
class Uac extends AbstractHelper
{
    protected $sm;

    /**
     * @param $nom
     *
     * @return string
     */
    public function __invoke($nom)
    {
        return $this->getUac($nom);
    }

    /**
     * @param $sm
     *
     * @return mixed
     */
    public function setSm($sm)
    {
        if (!$this->sm){
            $this->sm = $sm;
        }
        return $this->sm;
    }

    /**
     * @param $nom
     *
     * @return string
     */
    public function getUac($nom)
    {
        //Service
        $sm     =  $this->sm->getServiceLocator();
        $app    =  $sm->get('Application');
        $e      =  $app->getMvcEvent();
        $match  =  $e->getRouteMatch();

        if($match->getParam('lang') == $nom)
        {
            return ' class="active"';
        }
        elseif($match->getParam('url2') == $nom)
        {
            return ' class="active"';
        }
        elseif($match->getParam('url') == $nom)
        {
           return ' class="active"';
        }
        else
        {
           return;
        }
    }
}
