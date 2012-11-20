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

class QuSave extends AbstractTableGateway
{
    protected $table = 'QuAdmin';
    protected $adapter;
    protected $QuPhpThumb;

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
     * @return array|\ArrayObject|null
     * @throws \Exception
     */
    public function getQuAdmin($id,$lang)
    {
        $id  = (int) $id;
        $RowSet = $this->select(array('id_lang' => $id,'lang' => $lang));
        $row = $RowSet->current();
        if (!$row) {

            $RowSet = $this->select(array('id_lang' => $id));

            //is possible auto translate
            $row = $RowSet->current();

            if (!$row) {

                $RowSet = $this->select(array('id' => $id));
                $row = $RowSet->current();

                if (!$row) {
                    throw new \Exception("Could not find row $id and $lang");
                }
                return $row;
            }
            return $row;
        }
        return $row;
    }

    /**
     * @param QuFilter $qu_admin
     * @param           $type
     * @param           $lang
     * @param           $file
     *
     * @return int
     * @throws \Exception
     */
    public function getSave(QuFilter $qu_admin,$type,$lang,$file)
    {
        if($qu_admin->name == '') $qu_admin->name = $qu_admin->title;

        $qu_admin->name     = QuUtilities::urlc($qu_admin->name);
        $qu_admin->summary  = stripslashes($qu_admin->summary);
        $qu_admin->content  = stripslashes($qu_admin->content);

        $data = array(

            'id'                => $qu_admin->id,

            'id_parent'         => $qu_admin->id_parent,
            'id_author'         => $qu_admin->id_author,
            'id_lang'           => $qu_admin->id_lang,

            'type'              => $type,
            'name'              => $qu_admin->name,

            'date'              => $qu_admin->date,
            'modified'          => $qu_admin->modified,
            'status'            => $qu_admin->status,
            'lang'              => $qu_admin->lang,

            'parameters'        => $qu_admin->parameters,

            'title'             => $qu_admin->title,
            'summary'           => $qu_admin->summary,
            'documents'         => $qu_admin->documents,
            'content'           => $qu_admin->content,

            'notes'             => $qu_admin->notes
        );

        if($qu_admin->id_lang === 0){
            $id = (int)$qu_admin->id;
        }else{
            $id = (int)$qu_admin->id_lang;
        }
        if($id != 0){
            $row = $this->getQuAdmin($id,$lang);
        }

        if($qu_admin->id_lang === 0)
        {
            // Add
            $data['id']      = $this->getLastId($qu_admin->id_parent);
            $data            = $this->getQuPhpThumb()->create($file,$data,$type);
            $data['id_lang'] = $data['id'];
            $this->update($data, array('id' => $data['id']));
            return $data['id'];
        }
        elseif($row->lang === $qu_admin->lang)
        {
            // Edit
            $data = $this->getQuPhpThumb()->create($file,$data,$type);
            unset($data['date']);
            if($lang != ''){
                $Up = array('id_lang' => $id,'lang'=>$lang);
            }else{
                $Up = array('id_lang' => $id);
            }
            $this->update($data,$Up);
            return $id;
        }
        elseif($row->lang != $qu_admin->lang)
        {
            // Translate
            $data['order'] =  $row->order;
            $data['id_lang'] = $qu_admin->id;
            unset($data['id']);
            $this->insert($data);
            return $this->LastInsertValue;
        }
        else
        {
            throw new \Exception('Form id does not exist');
        }
    }

    /**
     * @param $id_parent
     *
     * @return mixed
     */
    public function getLastId($id_parent)
    {
        //LastInsert Id
        $sql = $this->getSql();
        $select = $sql->select();

        $where  = new Where();
        $where->equalTo('id_parent', $id_parent);
        $select->where($where)->order('order desc');

        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();
        $row       = $result->current();

        $data['order'] = $row['order'] + 1;
        $this->insert($data);
        return  $this->LastInsertValue;
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