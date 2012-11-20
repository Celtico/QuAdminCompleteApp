<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class QuLangDetect extends AbstractHelper
{
    /**
     * @var
     */
    protected $LangDetect;

    /**
     * @param $LangDetect
     */
    public function __construct($LangDetect){

        $this->LangDetect = $LangDetect;
    }

    /**
     * @param $id
     * @param $lang
     *
     * @return mixed
     */
    public function __invoke($id,$lang){

        return $this->LangDetect->getLangDetect($id,$lang);
    }
}