<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Controller;

use Zend\View\Model\ViewModel;

class  QuActionAjax
{
    /**
     * @var
     */
    protected $View;
    /**
     * @var
     */
    protected $Order;

    /**
     * @param $View
     * @param $Order
     */
    public function __construct($View,$Order){

        $this->View         = $View;
        $this->Order        = $Order;

    }

    /**
     * @param $cont
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function Action($cont){

        //Query and Match
        $Query = $cont->getRequest()->getQuery();
        $Match = $cont->getEvent()->getRouteMatch();

        //Order
        $item  = $Query->get('item');
        $n     = $Query->get('n');

        if($item != '')
            $this->Order->saveOrder($item,$n);

        //Search
        $q    = $Query->get('q');

        //Num x page
        $npp  = $Query->get('npp');

        //Num page
        $page = $Query->get('page', 1);

        //Url
        $lang         =      $Match->getParam('lang');
        $id           = (int)$Match->getParam('id','0');
        $id_parent    = (int)$Match->getParam('id_parent','0');
        $route        =      $Match->getMatchedRouteName();
        $type         =      explode('/',$route);
        $type         =      $type[1];
        $type         =      strtolower($type);

        //Model
        $qu_admin          =    $this->View->Paginator($id,$page,$type,$lang,$q,$npp);

        $Params = array(

            //Url and other params view
            'id'        => $id,
            'id_parent' => $id_parent,
            'lang'      => $lang,
            'route'     => $route,
            'q'         => $q,
            'npp'       => $npp,
            'page'      => $page,
            'ajax'      => 1,

            //Model
            'qu_admin'       => $qu_admin,
        );

        $view = new ViewModel($Params);
        return $view->setTerminal(true);
    }
}
