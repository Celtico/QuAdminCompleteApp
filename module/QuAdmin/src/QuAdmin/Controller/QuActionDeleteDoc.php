<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Controller;

class QuActionDeleteDoc
{

    /**
     * @var
     */
    protected $DeleteDoc;

    /**
     * @param $DeleteDoc
     */
    public function __construct($DeleteDoc){

        $this->DeleteDoc = $DeleteDoc;
    }

    /**
     * @param $cont
     *
     * @return array
     */
    public function Action($cont){

        //Request & Match & Redirect &
        $Match     = $cont->getEvent()->getRouteMatch();
        $Redirect  = $cont->redirect();
        $Fm        = $cont->flashMessenger()->setNamespace('QuAdmin');

        //Url
        $lang      =      $Match->getParam('lang');
        $id        = (int)$Match->getParam('id','0');
        $id_parent = (int)$Match->getParam('id_parent','0');
        $route    =       $Match->getMatchedRouteName();

        if($id_parent != 0){

            $this->DeleteDoc->DeleteDocument($id_parent);

            $Fm->addMessage(
                array(
                    'type'      =>$cont->t('DeleteDocClassType'),
                    'message'   =>$cont->t('DeleteDocMessage')
                )
            );
            return $Redirect->toRoute($route,array(
                'action'   =>'edit',
                'id'       => $id,
                'lang'     => $lang
            ));

        }else{
            
            $Fm->addMessage(
                array(
                    'type'      =>$cont->t('DeleteDocFailClassType'),
                    'message'   =>$cont->t('DeleteDocFailMessage')
                )
            );
            return $Redirect->toRoute($route,array(
                'action'   =>'edit',
                'id'       => $id,
                'lang'     => $lang
            ));
        }

    }
}
