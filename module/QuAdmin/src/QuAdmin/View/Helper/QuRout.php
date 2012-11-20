<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class QuRout extends AbstractHelper
{
    /**
     * @var
     */
    protected $QuRout;

    /**
     * @param $QuRout
     */
    function __construct($QuRout)
    {
        return $this->QuRout = $QuRout;
    }

    /**
     * @param $id
     * @param $lang
     *
     * @return mixed
     */
    public function __invoke($id,$lang)
    {
        return $this->QuRout->getRout($id,$lang);
    }
}