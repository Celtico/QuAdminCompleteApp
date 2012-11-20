<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;

class QuUser extends AbstractTableGateway
{
    protected $table = 'user';
    protected $tableName = 'user';

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
    public function getQuUser($id)
    {
        $id  = (int) $id;
        $RowSet = $this->select(array('user_id' => $id));
        $Row = $RowSet->current();
        if (!$Row){
            return;
        }
        return $Row;
    }


}
