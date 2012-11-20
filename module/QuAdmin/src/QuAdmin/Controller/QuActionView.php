<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Controller;

class QuActionView
{
    /**
     * @var
     */
    protected $View;
    protected $Form;
    protected $User;

    /**
     * @param $View
     * @param $Form
     * @param $User
     */
    public function __construct($View,$Form,$User){

        $this->View         = $View;
        $this->Form         = $Form;
        $this->User         = $User;
    }

    /**
     * @param $cont
     *
     * @return array
     */
    public function Action($cont){

        $Match = $cont->getEvent()->getRouteMatch();

        $author  = '';
        if($this->User->getIdentity()){
        $author     =      $this->User->getIdentity()->getId();
        }

        $lang       =      $Match->getParam('lang');
        $id         = (int)$Match->getParam('id','0');
        $id_parent  = (int)$Match->getParam('id_parent','0');
        $route      =      $Match->getMatchedRouteName();
        $type       =      explode('/',$route);

        if(isset($type[1])){
            $type       =      $type[1];
        }else{
            $type       =      $route;
        }
        $type           =      strtolower($type);

        $qu_admin       =      $this->View->Paginator($id,$page = 1,$type,$lang,$q = '',$npp = '');
        $date           =      date("Y-m-d H:i:s");

        return array(
            'date'      => $date,
            'modified'  => $date,
            'form'      => $this->Form,
            'id_lang'   => 0,
            'action'    => 'add',
            'id_author' => $author,
            'id'        => $id,
            'id_parent' => $id_parent,
            'lang'      => $lang,
            'route'     => $route,
            'npp'       => 10,
            'page'      => 1,
            'q'         => '',
            'qu_admin'  => $qu_admin,
        );
    }



}
