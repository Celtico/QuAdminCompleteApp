<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Model;

use Zend\Db\Adapter\Adapter;
use QuAdmin\Form\QuFilter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Where;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Stdlib\Hydrator\ArraySerializable as ArraySerializableHydrator;


class QuView extends AbstractTableGateway
{
    protected $table     = 'QuAdmin';
    protected $tableName = 'QuAdmin';

    /**
     * @param \Zend\Db\Adapter\Adapter $adapter
     * @param string                   $tableName
     */
    public function __construct(Adapter $adapter, $tableName = 'QuAdmin')
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype =
        new HydratingResultSet(
            new ArraySerializableHydrator,
            new QuFilter()
        );
        $this->resultSetPrototype->buffer();
        $this->initialize();
    }

    /**
     * @param $id_parent
     * @param $page
     * @param $type
     * @param $lang
     * @param $q
     * @param $npp
     *
     * @return \Zend\Paginator\Paginator
     */
    public function Paginator($id_parent,$page,$type,$lang,$q,$npp)
    {
        $select = $this->getSql()->select();
        $where  = new Where();

        $where->equalTo('id_parent', $id_parent);
        $where->equalTo('type', $type);

        if($lang != ''){
            $where->equalTo('lang', $lang);
        }
        if($q != ''){
           $where->like('title',  '%'.$q.'%');
           $where->or;
           $where->like('summary',  '%'.$q.'%');
           $where->or;
           $where->like('content',  '%'.$q.'%');
        }

        $select->where($where)->order('order desc');

        $paginator =  new Paginator(new DbSelect($select, $this->adapter, $this->resultSetPrototype));

        $paginator->setCurrentPageNumber($page);

        if(!$npp)
            $npp = 10;

        $paginator->setItemCountPerPage($npp);

        return $paginator;
    }

    /**
     * @param $type
     * @param $camp
     *
     * @return array
     */
    public function Sel($type,$camp)
    {
        $sql = $this->getSql();
        $selector = array();
        $select = $sql->select();

        $where  = new Where();
        $where->equalTo('type', $type);
        $select->where($where)->order('order desc');

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $select = array_values(iterator_to_array($result));

        foreach($select as  $sel){
            if(isset($sel['title'])){
                $selector[$sel[$camp]] =  $sel['title'];
            }
        }
        if(count($selector) == 0){
            $selector = array(''=>'-');
        }
        return $selector;
    }
}
