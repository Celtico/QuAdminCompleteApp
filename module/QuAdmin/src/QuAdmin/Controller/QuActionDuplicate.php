<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Controller;

class QuActionDuplicate
{
    /**
     * @var
     */
    protected $Duplicate;

    /**
     * @param $Duplicate
     */
    public function __construct($Duplicate){

        $this->Duplicate    = $Duplicate;
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
                        'type'      =>$cont->t('DuplicateNotCheckedClassType'),
                        'message'   =>$cont->t('DuplicateNotCheckedMessage')
                    )
                );
                return $Redirect->toRoute($route,array(
                    'action'=>'index',
                    'id'       => $id,
                    'lang'     => $lang
                ));
            }

            if($Action['action'] == 'duplicate'){

                $Duplicate = array();
                foreach($Action['checkRow'] as $idCheck){
                    $Duplicate[] = $this->Duplicate->setDuplicate($idCheck);
                }
                return array(
                    'Duplicate' => $Duplicate,
                    'id'        => $id,
                    'lang'      => $lang,
                    'route'     => $route,
                );

            }elseif($Action['duplicate'] != ''){

                foreach($Action['checkRow'] as $idCheck){
                    $this->Duplicate->Duplicate($idCheck);
                }
                $Fm->addMessage(
                    array(
                        'type'      =>$cont->t('DuplicateClassType'),
                        'message'   =>$cont->t('DuplicateMessage')
                    )
                );
                return $Redirect->toRoute($route,array(
                    'action'=>'index',
                    'id'       => $id,
                    'lang'     => $lang
                ));

            }elseif($Action['cancel'] != ''){

                $Fm->addMessage(
                    array(
                        'type'      =>$cont->t('DuplicateCancelClassType'),
                        'message'   =>$cont->t('DuplicateCancelMessage')
                    )
                );
                return $Redirect->toRoute($route,array(
                    'action'=>'index',
                    'id'       => $id,
                    'lang'     => $lang
                ));
            }

        }elseif($id_parent != 0){

            $Duplicate = array($this->Duplicate->setDuplicate($id_parent));
            return array(
                'Duplicate' => $Duplicate,
                'id'        => $id,
                'lang'      => $lang,
                'route'     => $route,
            );

        }else{

            $Fm->addMessage(
                array(
                    'type'      =>$cont->t('DuplicateNotCheckedClassType'),
                    'message'   =>$cont->t('DuplicateNotCheckedMessage')
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
