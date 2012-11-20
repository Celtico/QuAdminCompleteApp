<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class QuActive extends AbstractHelper
{

    /**
     * @param $param
     * @param $active
     * @param $css
     *
     * @return string
     */
    public function __invoke($param,$active,$css)
    {
        return $this->getActive($param,$active,$css);
    }

    /**
     * @param $param
     * @param $active
     * @param $css
     *
     * @return string
     */
    public function getActive($param,$active,$css)
    {
        if($param == $active){
            $active = $css;
        }else{
            $active = '';
        }
        return $active;
    }
}
