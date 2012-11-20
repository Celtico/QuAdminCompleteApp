<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Controller;

class QuActionEdit
{
    /**
     * @var
     */
    protected $View;
    protected $Form;
    protected $Save;
    protected $User;
    protected $Trans;

    public function __construct($View,$Form,$Save,$User){

        $this->View = $View;
        $this->Form = $Form;
        $this->Save = $Save;
        $this->User = $User;
    }

    /**
     * @param $cont
     *
     * @return array
     */
    public function Action($cont){

        //Request and Match and Redirect
        $Request  = $cont->getRequest();
        $Match    = $cont->getEvent()->getRouteMatch();
        $Redirect = $cont->redirect();
        $Fm       = $cont->flashMessenger()->setNamespace('QuAdmin');

        $lang     =      $Match->getParam('lang');
        $id       = (int)$Match->getParam('id','0');
        $id_parent= (int)$Match->getParam('id_parent','0');
        $route    =      $Match->getMatchedRouteName();
        $type     =      explode('/',$route);
        $type     =      $type[1];
        $type     = strtolower($type);

        $author   =    $this->User->getIdentity()->getId();

        //From
        $date     = date("Y-m-d H:i:s");

        $qu_admin = $this->Save->getQuAdmin($id,$lang);

        $this->Form->bind($qu_admin);

        //Action for post Add
        if($Request->isPost()){

            $Action = $Request->getPost();

            //Action cancel
            if($Action['close'] != '')
            {
                $Fm->addMessage(
                    array(
                        'type'      =>$cont->t('EditCloseClassType'),
                        'message'   =>$cont->t('EditCloseMessage')
                    )
                );
                return $Redirect->toRoute($route,array(
                        'id'  => $qu_admin->id_parent,
                        'lang'=> $lang
                ));
            }

            $this->Form->setData($Request->getPost());

            //Action edit
            if($this->Form->isValid())
            {
                $this->Save->getSave(
                    $qu_admin,
                    $type,
                    $lang,
                    $_FILES
                );

                if($Action['save'] != '')
                {
                    $Fm->addMessage(
                        array(
                            'type'      =>$cont->t('EditSaveClassType'),
                            'message'   =>$cont->t('EditSaveMessage')
                        )
                    );
                    return $Redirect->toRoute($route,array(
                        'action' => 'edit',
                        'id'     => $id,
                        'lang'   => $lang
                    ));
                }
                elseif($Action['saveandclose'] != '')
                {
                    $Fm->addMessage(
                        array(
                            'type'      =>$cont->t('EditSaveCloseClassType'),
                            'message'   =>$cont->t('EditSaveCloseMessage')
                        )
                    );
                    return $Redirect->toRoute($route,array(
                        'id' => $qu_admin->id_parent,
                        'lang'   => $lang
                    ));
                }
            }
        }

        return array(
            'date'      => $date,
            'modified'  => $date,
            'form'      => $this->Form,
            'id_lang'   => $id,
            'action'    => 'edit',
            'id_author' => $author,
            'id'        => $id,
            'id_parent' => $qu_admin->id_parent,
            'lang'      => $lang,
            'route'     => $route,
            'qu_admin'  => $this->View->Paginator($id_parent,$page = 1,$type,$lang,$q = '',$npp = '')
        );
    }
}