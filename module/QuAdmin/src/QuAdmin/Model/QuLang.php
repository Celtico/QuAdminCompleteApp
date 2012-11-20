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
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Where;


class QuLang extends AbstractTableGateway
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
        $this->resultSetPrototype->setArrayObjectPrototype(new QuFilter());
        $this->initialize();
    }

    /**
     * Get Lang Helper
     *
     * @param $id
     * @param $lang
     *
     * @return array|\ArrayObject|int|null
     */
    public function getLangDetect($id,$lang)
    {
        $id  = (int) $id;
        $RowSet = $this->select(array('id_lang' => $id,'lang' => $lang));
        $row = $RowSet->current();
        if (!$row) {
            return 0;
        }
        return $row;
    }

    /**
     * @return array
     */
    public function getLangNav()
    {
        $sql    = $this->getSql();
        $select = $sql->select();
        $where  = new Where();

        $where->equalTo('type', 'languages');
        $select->where($where)->order('order desc');

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $select = array_values(iterator_to_array($result));

        foreach($select as  $sel){
            if(isset($sel['title'])){
                $selector[$sel['name']] =  $sel['title'];
            }
        }
        if(!isset($selector)){
            $selector = array();
        }
        return $selector;
    }
}
