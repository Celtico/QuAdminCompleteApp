<?php
/**
 * @Author: Cel Ticó Petit
 * @Company: Cencis s.c.p.
 * @Contact: cel@cenics.net
 */
namespace QuWebDemo;

use QuWebDemo\Model\QuWebDemo;

class Module
{

    /**
     * Provisional model
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'QuWebDemo' =>  function($sm) {
                    $dbAdapter  = $sm->get('Zend\Db\Adapter\Adapter');
                    return new QuWebDemo($dbAdapter);
                },
            )
         );
    }

    /**
     * Provisional Helpers
     * @return array
     */
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                /**
                 * Get content db
                 */
                'cont' => function ($sm) {
                    $select = new View\Helper\Cont($sm->getServiceLocator());
                    return $select;
                },
                /**
                 * Get images
                 * Extract path config QuPhpThumb
                 */
                'img' => function($sm){
                    $config = $sm->getServiceLocator()->get('config');
                    $select = new View\Helper\Img($config['QuAdminConfig']['QuPhpThumb']);
                    return $select;
                },
                /**
                 * Get css active class menu
                 */
                'uac' => function ($sm) {
                    $select = new View\Helper\Uac;
                    $select->setSm($sm);
                    return $select;
                },
            ),
        );
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
