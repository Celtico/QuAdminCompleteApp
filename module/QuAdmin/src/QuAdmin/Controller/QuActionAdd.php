<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Controller;

use QuAdmin\Form\QuFilter;

class QuActionAdd
{
    /**
     * @var
     */
    protected $View;
    protected $Rout;
    protected $Form;
    protected $Save;
    protected $User;

    /**
     * @param $View
     * @param $Form
     * @param $Save
     * @param $User
     */
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

        //Action for post Add
        if($Request->isPost()){

            $Action = $Request->getPost();

            //Action cancel
            if($Action['close'] != '')
            {
                $Fm->addMessage(
                    array(
                        'type'      =>$cont->t('AddCloseClassType'),
                        'message'   =>$cont->t('AddCloseMessage')
                    )
                );
                return $Redirect->toRoute($route,array(
                        'id'     => $id,
                        'lang'   => $lang
                ));
            }

            //* Parse InputFilter
            $qu_admin = new QuFilter();
            $this->Form->setInputFilter($qu_admin->getInputFilter());
            $this->Form->setData($Request->getPost());

            //Action create add
            if($this->Form->isValid())
            {
                $qu_admin->exchangeArray($this->Form->getData());
                $redirect_id = $this->Save->getSave(
                    $qu_admin,
                    $type,
                    $lang,
                    $_FILES
                );

                if($Action['save'] != '')
                {
                    //Action save
                    $Fm->addMessage(
                        array(
                            'type'      =>$cont->t('AddSaveClassType'),
                            'message'   =>$cont->t('AddSaveMessage')
                        )
                    );
                    return $Redirect->toRoute($route,array(
                        'action'   => 'edit',
                        'id'       => $redirect_id,
                        'lang'     => $lang
                    ));
                }
                elseif($Action['saveandclose'] != '')
                {
                    //Action save and close
                    $Fm->addMessage(
                        array(
                            'type'      =>$cont->t('AddSaveCloseClassType'),
                            'message'   =>$cont->t('AddSaveCloseMessage')
                        )
                    );
                    return $Redirect->toRoute($route,array(
                        'id'       => $id,
                        'lang'     => $lang
                    ));
                }
            }
        }

        return array(
            'date'      => $date,
            'modified'  => $date,
            'form'      => $this->Form,
            'id_lang'   => 0,
            'action'    => 'add',
            'id_author' => $author,
            'id'        => $id, //url
            'id_parent' => $id,
            'lang'      => $lang,
            'route'     => $route,
            'qu_admin'  => $this->View->Paginator($id_parent,$page = 1,$type,$lang,$q = '',$npp = '')
        );
    }
}
