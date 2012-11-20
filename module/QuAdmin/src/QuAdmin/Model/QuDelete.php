<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;

class QuDelete extends AbstractTableGateway
{
    protected $table = 'QuAdmin';
    protected $adapter;
    protected $QuPhpThumb;

    /**
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter){

         $this->adapter = $adapter;
    }

    /**
     * @param $id
     *
     * @return array|\ArrayObject|null
     */
    public function setDelete($id)
    {
        $RowSet = $this->select(array('id_lang' => $id));
        $Row = $RowSet->current();
        return $Row;
    }

    /**
     * @param array|callable|string|\Zend\Db\Sql\Where $id
     *
     * @return int|void
     */
    public function DeleteAction($id)
    {
        $DeleteAll = $this->getDeleteAll($id);
        foreach($DeleteAll as $Row){
            $this->DeleteAction($Row['id']);
        }
        $this->DeleteDelete($id);
    }

    /**
     * @param $id
     *
     * @return int|void
     */
    public function DeleteDelete($id)
    {
        //Docs
        $info = $this->select(array('id' => $id))->current();
        $document = array('documents');
        foreach($document as $nd){
            $this->getQuPhpThumb()->Delete($info,$nd);
        }

        return  $this->delete(array('id' => $id));
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function getDeleteAll($id)
    {
        $select = $this->select(array('id_parent' => $id));
        return $select->toArray();
    }

    /**
     * @param $id
     *
     * @return array|\ArrayObject|null
     */
    public function DeleteDocument($id)
    {
        //Docs
        $info = $this->select(array('id' => $id))->current();
        $document = array('documents');
        foreach($document as $nd){
            $this->getQuPhpThumb()->Delete($info,$nd);
            $data[$nd]= '';
        }
        return $this->update($data, array('id' => $id));
    }

    /**
     * @param $QuPhpThumb
     *
     * @return mixed
     */
    public function setQuPhpThumb($QuPhpThumb)
    {
        return $this->QuPhpThumb = $QuPhpThumb;
    }

    /**
     * @return mixed
     */
    public function getQuPhpThumb()
    {
        return $this->QuPhpThumb;
    }

}