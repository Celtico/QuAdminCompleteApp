<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuWebDemo\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Get content db
 */
class Cont extends AbstractHelper
{
    protected $Service;

    /**
     * @param $Service
     */
    public function __construct($Service)
    {
        $this->Service   = $Service;
    }

    /**
     * @param $parameters
     * @param $typo
     * @param $url
     * @param $parent
     *
     * @return mixed
     */
    public function __invoke($parameters,$typo,$url,$parent)
    {
        return $this->getQuWebDemo($parameters,$typo,$url,$parent);
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
     * @param $parameters
     * @param $typo
     * @param $url
     * @param $parent
     *
     * @return mixed
     */
    public function getQuWebDemo($parameters,$typo,$url,$parent)
    {

        //Get Service
        $sel    =  $this->Service->get('QuWebDemo');
        $app    =  $this->Service->get('Application');
        $e      =  $app->getMvcEvent();
        $match  =  $e->getRouteMatch();

        //Control Lang
        $lang   = $match->getParam('lang');
        if ($lang == '') {
            $lang = 'es';
        }
        $array['lang']       = $lang;

        //Url primary
        if($url == 'url'){
            $url   = $match->getParam('url');
            if($url == ''){
                $url = 'index';
            }
            $array['name'] = $url;
        }

        //Url secondary
        if($url == 'url2'){
            $url = $match->getParam('url2');
            if($url != ''){
                $array['name'] = $url;
            }
        }

        //Parameters
        if($parameters != ''){
            $array['parameters'] = $parameters;
        }

        //Languages
        if($parameters == 'languages'){
            $array['type'] = 'languages';
            unset($array['parameters']);
            unset($array['lang']);
        }

        //Id Parent
        if($parent != ''){
            $array['id_parent'] = $parent;
        }

        //Select all or Row
        if($typo == 'all')
        {
          $select = $sel->getAll($array);
        }
        elseif($typo == 'row')
        {
          $select = $sel->getRow($array);
        }

        return $select;
    }
}
