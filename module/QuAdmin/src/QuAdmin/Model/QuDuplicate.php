<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;

class QuDuplicate extends AbstractTableGateway
{
    public $table = 'QuAdmin';
    public $adapter;
    public $Config;

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
    public function setDuplicate($id)
    {
        $RowSet = $this->select(array('id_lang' => $id));
        $Row = $RowSet->current();
        return $Row;
    }

    /**
     * @param $id
     */
    public function Duplicate($id)
    {
        if($id != '' and $id != 0)
        {
            $LastInsertValue = $this->getDuplicate($id);
            $this->DuplicatePos($id,$LastInsertValue);
        }
    }

    /**
     * @param $id
     * @param $LastInsertValue
     */
    public function DuplicatePos($id,$LastInsertValue)
    {
        $DuplicateAll = $this->getDuplicateAll($id);
        foreach($DuplicateAll as $Row){
            $Last = $this->getDuplicatePos($Row,$LastInsertValue);
            $this->DuplicatePos($Row['id'],$Last);
        }
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getDuplicate($id)
    {
        //Select
        $RowSet = $this->select(array('id' => $id));
        $row = $RowSet->toArray();
        $row = $row[0];

        //Insert
        unset($row['id']);
        $row['order'] = $row['order'] + 1;
        $row['title'] = $row['title'].' (duplicate)';
        $this->insert($row);
        $LastInsertValue = $this->LastInsertValue;

        //Docs
        $data = $this->DuplicateDocuments($row,$LastInsertValue);

        //Update
        $data['id_lang'] = $LastInsertValue;
        $this->update($data, array('id' => $LastInsertValue));

        return  $LastInsertValue;

    }

    /**
     * @param $Row
     * @param $LastInsertValue
     *
     * @return mixed
     */
    public function getDuplicatePos($Row,$LastInsertValue)
    {
        //Insert
        unset($Row['id']);
        $Row['id_parent']   = $LastInsertValue;
        $Row['title']       = $Row['title'].' (duplicate)';
        $this->insert($Row);
        $LastInsertValue    = $this->LastInsertValue;

        //Doc
        $data = $this->DuplicateDocuments($Row,$LastInsertValue);

        //Update
        $data['id_lang'] = $LastInsertValue;
        $this->update($data, array('id' => $LastInsertValue));

        return  $LastInsertValue;
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function getDuplicateAll($id)
    {
        $select = $this->select(array('id_parent' => $id));
        return $select->toArray();
    }

    /**
     * @param $row
     * @param $LastInsertValue
     *
     * @return array
     */
    public function DuplicateDocuments($row,$LastInsertValue)
    {
        $this->getConfig();

        // Duplicate documents
        $document = array('documents');
        foreach($document as $nd){

            $nom = explode('-',$row[$nd]);
            foreach($nom as $key => $n){
                if($key == 0){
                    $name = $n;
                }elseif($key == 1){
                    $name .= '-'.$LastInsertValue;
                }else{
                    $name .= '-'.$n;
                }
            }
            $data[$nd] = $name;

            $copy1 = $this->Config['QuBasePath'].'/'.$row['type'].'/'.$row[$nd];
            if(is_file($copy1)){
                $doc1 =  $this->Config['QuBasePath'].'/'.$row['type'].'/'.$data[$nd];
                copy($copy1,$doc1);
                @chmod($doc1, 0777);
            }

            $copy2 = $this->Config['QuBasePath'].'/'.$row['type'].'/s'.$row[$nd];
            if(is_file($copy2)){
                $doc2 =  $this->Config['QuBasePath'].'/'.$row['type'].'/s'.$data[$nd];
                copy($copy2,$doc2);
                @chmod($doc2, 0777);
            }

        }
        return $data;
    }

    /**
     * @param $Config
     *
     * @return mixed
     */
    public function setConfig($Config)
    {
        return $this->Config = $Config;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->Config;
    }
}