<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class QuAdmin extends AbstractActionController
{

    protected $QuActionView;
    protected $QuActionAjax;
    protected $QuActionAdd;
    protected $QuActionEdit;
    protected $QuActionDuplicate;
    protected $QuActionDelete;
    protected $QuActionDeleteDoc;

    protected $Translator;


    /**
     * @return array
     */
    public function indexAction(){
        return $this->QuActionView->Action($this);
    }

    /**
     * @param $QuActionView
     *
     * @return mixed
     */
    public function setViewAction($QuActionView){
        if(!$this->QuActionView){
            return $this->QuActionView = $QuActionView;
        }
    }

    /**
     * @return mixed
     */
    public function ajaxAction(){
        return $this->QuActionAjax->Action($this);
    }

    /**
     * @param $QuActionAjax
     *
     * @return mixed
     */
    public function setAjaxAction($QuActionAjax){
        if(!$this->QuActionAjax){
            return $this->QuActionAjax = $QuActionAjax;
        }
    }

    /**
     * @return mixed
     */
    public function addAction(){
        return $this->QuActionAdd->Action($this);
    }

    /**
     * @param $QuActionAdd
     *
     * @return mixed
     */
    public function setAddAction($QuActionAdd){
        if(!$this->QuActionAdd){
            return $this->QuActionAdd = $QuActionAdd;
        }
    }

    /**
     * @return mixed
     */
    public function editAction(){
        return $this->QuActionEdit->Action($this);
    }

    /**
     * @param $QuActionEdit
     *
     * @return mixed
     */
    public function setEditAction($QuActionEdit){
        if(!$this->QuActionEdit){
            return $this->QuActionEdit = $QuActionEdit;
        }
    }

    /**
     * @return mixed
     */
    public function duplicateAction(){
        return $this->QuActionDuplicate->Action($this);
    }

    /**
     * @param $QuActionDuplicate
     *
     * @return mixed
     */
    public function setDuplicateAction($QuActionDuplicate){
        if(!$this->QuActionDuplicate){
            return $this->QuActionDuplicate = $QuActionDuplicate;
        }
    }

    /**
     * @return mixed
     */
    public function deleteAction(){
        return $this->QuActionDelete->Action($this);
    }

    /**
     * @param $QuActionDelete
     *
     * @return mixed
     */
    public function setDeleteAction($QuActionDelete){
        if(!$this->QuActionDelete){
            return $this->QuActionDelete = $QuActionDelete;
        }
    }

    /**
     * @return mixed
     */
    public function deleteDocAction(){
        return $this->QuActionDeleteDoc->Action($this);
    }

    /**
     * @param $QuActionDeleteDoc
     *
     * @return mixed
     */
    public function setDeleteDocAction($QuActionDeleteDoc){
        if(!$this->QuActionDeleteDoc){
            return $this->QuActionDeleteDoc = $QuActionDeleteDoc;
        }
    }

    /**
     * @param string $text
     *
     * @return mixed
     */
    public function t($text = ''){
      return $this->Translator->Translate($text);
    }

    /**
     * @param $Translator
     *
     * @return mixed
     */
    public function setTranslator($Translator){
        return $this->Translator = $Translator;
    }
}