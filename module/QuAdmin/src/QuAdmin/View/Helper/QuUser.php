<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class QuUser extends AbstractHelper
{
    protected $QuUser;

    /**
     * @param $QuUser
     */
    public function __construct($QuUser){

        $this->QuUser = $QuUser;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function __invoke($id){

        return $this->QuUser->getQuUser($id)->display_name;
    }

}