<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Controller;

class QuActionDelete
{

    /**
     * @var
     */
    protected $Delete;

    /**
     * @param $Delete
     */
    public function __construct($Delete){

        $this->Delete = $Delete;
    }

    /**
     * @param $cont
     *
     * @return array
     */
    public function Action($cont){

        //Request & Match & Redirect &
        $Request  = $cont->getRequest();
        $Match    = $cont->getEvent()->getRouteMatch();
        $Redirect = $cont->redirect();
        $Fm       = $cont->flashMessenger()->setNamespace('QuAdmin');

        //Url
        $lang     =      $Match->getParam('lang');
        $id       = (int)$Match->getParam('id','0');
        $id_parent= (int)$Match->getParam('id_parent','0');
        $route    =      $Match->getMatchedRouteName();


        if($Request->isPost()){
            $Action = $Request->getPost();

            if($Action['checkRow'] == ''){

                $Fm->addMessage(
                    array(
                        'type'      =>$cont->t('DeleteNotCheckedClassType'),
                        'message'   =>$cont->t('DeleteNotCheckedMessage')
                    )
                );
                return $Redirect->toRoute($route,array(
                    'action'=>'index',
                    'id'       => $id,
                    'lang'     => $lang
                ));
            }

            if($Action['action'] == 'delete'){

                $Delete = array();
                foreach($Action['checkRow'] as $idCheck){
                    $Delete[] = $this->Delete->setDelete($idCheck);
                }
                return array(
                    'Delete' => $Delete,
                    'id'        => $id,
                    'lang'      => $lang,
                    'route'     => $route,
                );

            }elseif($Action['delete'] != ''){

                foreach($Action['checkRow'] as $idcheck){
                    $this->Delete->DeleteAction($idcheck);
                }
                $Fm->addMessage(
                    array(
                        'type'      =>$cont->t('DeleteClassType'),
                        'message'   =>$cont->t('DeleteMessage')
                    )
                );
                return $Redirect->toRoute($route,array(
                    'action'   =>'index',
                    'id'       => $id,
                    'lang'     => $lang
                ));

            }elseif($Action['cancel'] != ''){

                $Fm->addMessage(
                    array(
                        'type'      =>$cont->t('DeleteCancelClassType'),
                        'message'   =>$cont->t('DeleteCancelMessage')
                    )
                );
                return $Redirect->toRoute($route,array(
                    'action'   =>'index',
                    'id'       => $id,
                    'lang'     => $lang
                ));
            }

        }elseif($id_parent != 0){

            $Delete = array($this->Delete->setDelete($id_parent));
            return array(
                'Delete'    => $Delete,
                'id'        => $id,
                'lang'      => $lang,
                'route'     => $route,
            );

        }else{
            
            $Fm->addMessage(
                array(
                    'type'      =>$cont->t('DeleteNotCheckedClassType'),
                    'message'   =>$cont->t('DeleteNotCheckedMessage')
                )
            );
            return $Redirect->toRoute($route,array(
                'action'=>'index',
                'id'       => $id,
                'lang'     => $lang
            ));
        }

    }
}
