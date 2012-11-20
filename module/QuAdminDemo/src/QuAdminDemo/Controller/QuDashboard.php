<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdminDemo\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class QuDashboard extends AbstractActionController
{
    public function indexAction(){
        return array('dashboard' => 'Your Dashboard');
    }
}