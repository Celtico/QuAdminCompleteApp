<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuWebDemo\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Where;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\ArraySerializable as ArraySerializableHydrator;

class QuWebDemo extends AbstractTableGateway
{
    public $table = 'QuAdmin';
    public $adapter;

    /**
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype =
            new HydratingResultSet(

                new ArraySerializableHydrator,

                new \QuAdmin\Form\QuFilter()
            );
        $this->resultSetPrototype->buffer();
        $this->initialize();
    }

    /**
     * @param array $array
     *
     * @return mixed
     */
    public function getRow($array = array())
    {
        $sql = $this->getSql();
        $select = $sql->select();

        $where  = new Where();
        foreach($array as $key=>$a){
            $where->equalTo($key, $a);
        }
        $select->where($where)->order('order desc');
        //var_dump($select->getSqlString());
        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();
        $row       = $result->current();
        return $row;
    }

    /**
     * @param array $array
     *
     * @return array
     */
    public function getAll($array = array())
    {
        $sql = $this->getSql();
        $select = $sql->select();

        $where  = new Where();
        foreach($array as $key=>$a){
            $where->equalTo($key, $a);
        }
        $select->where($where)->order('order desc');
        //var_dump($select->getSqlString());
        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();
        $rows = iterator_to_array($result);
        return $rows;
    }
}
