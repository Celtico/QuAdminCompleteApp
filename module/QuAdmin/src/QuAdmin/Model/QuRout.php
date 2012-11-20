<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Where;

use QuAdmin\Form\QuFilter;

class QuRout extends AbstractTableGateway
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
     * @param $id
     * @param $lang
     *
     * @return array
     */
    public function getRout($id,$lang){

        $num_fam = '0';
        $array  = array();
        if($lang != ''){
            if($id != '0' and $id != ''){

                while($id != '' or $id == '0'){

                    $sql = $this->getSql();
                    $select = $sql->select();

                    $where  = new Where();
                    $where->equalTo('id_lang', $id);

                    if($lang != ''){
                        $where->equalTo('lang', $lang);
                        $select->where($where);
                    }

                    $statement = $sql->prepareStatementForSqlObject($select);
                    $result    = $statement->execute();
                    $row       = $result->current();

                    $values = array(
                        'id_lang' => $row['id_lang'],
                        'id_parent' => $row['id_parent'],
                        'title' => $row['title']
                    );

                    array_unshift($array, $values);
                    $id = $row['id_parent'];
                    $num_fam++;
                }
            }
        }
        return $array;
    }
}
