<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;

class QuOrder extends AbstractTableGateway
{
    public $table = 'QuAdmin';
    public $adapter;

    /**
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter){

        $this->adapter = $adapter;
    }

    /**
     * @param $Order
     * @param $n
     */
    public function saveOrder($Order,$n)
    {
        $count = $n+1;
        foreach($Order as $o){
            $count--;
            $data['order'] = $count;
            $this->update($data, array('id' => $o));
        }
    }
}
