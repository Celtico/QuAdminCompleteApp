<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class QuNavView extends AbstractHelper
{

    /**
     * @var null
     */
    protected $pages;

    /**
     * @param null $pages
     */
    public function __construct($pages = null)
    {
        return  $this->pages = $pages;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     * @return null
     */
    public function getPages()
    {
        return  $this->pages;
    }

    /**
     * @return mixed
     */
    public function getNameActive()
    {
        $active = '';
        $pageArray = $this->pages->toArray();
        foreach($this->pages->toArray() as $p){
            $active[$p['route']] = $p['pages'];
        }
        $keyPrimary = array_keys($active);
        foreach($keyPrimary as $test){
            foreach($active[$test] as $ac){
                if($ac['active']){
                    $act = $ac;
                }
            }
        }
        if(isset($act['label'])){
            return $act['label'];
        }elseif(isset($pageArray[0]['label'])){
            return $pageArray[0]['label'];
        }
    }

    /**
     * @return mixed
     */
    public function getModuleActive()
    {
        $active = '';
        foreach($this->pages->toArray() as $p){
            $active[$p['route']] = $p['pages'];
        }
        $keyPrimary = array_keys($active);
        foreach($keyPrimary as $test){
            foreach($active[$test] as $ac){
                if($ac['active']){
                    $act = $ac;
                }
            }
        }
        if(isset($act['route'])){
            $act = explode('/',$act['route']);
        }else{
            return;
        }
        return $act[0];
    }

}
