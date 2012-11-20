<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin;

use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\ModuleManager;

class Module implements BootstrapListenerInterface
{

    /**
     * @param \Zend\EventManager\EventInterface $e
     *
     * @return array|void
     */
    public function onBootstrap(EventInterface $e)
    {
        $app        = $e->getApplication();
        $sm         = $app->getServiceManager();
        $strategy   = $sm->get('QuAdminStrategy');

        $app->getEventManager()->attach($strategy);
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'QuAdminStrategy' => function() {
                    $QuRedirectLogin = new Service\QuAdminStrategy();
                    return $QuRedirectLogin;
                },
            ),
        );
    }

    /**
     * @return array
     */
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'QuFlashMessages' => function($sm) {
                    $Service = $sm->getServiceLocator();
                    $plugin  = $Service->get('ControllerPluginManager')->get('flashMessenger');
                    $class   = $Service->get('config');
                    $helper  = new View\Helper\QuFlashM($plugin,$class['QuAdminConfig']['QuFlashMCss']);
                    return $helper;
                },
                'QuUser' => function($sm) {
                    $db = $sm->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                    $QuUser = new Model\QuUser($db);
                    return new View\Helper\QuUser($QuUser);
                },
                'QuRout'=>function($sm){
                    $db = $sm->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                    $Rout = new Model\QuRout($db);
                    return new View\Helper\QuRout($Rout);
                },
                'QuLangNav'=>function($sm){
                    $db = $sm->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                    $QuLang = new Model\QuLang($db);
                    return new View\Helper\QuLangNav($QuLang);
                },
                'QuLangDetect'=>function($sm){
                    $db = $sm->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                    $QuLang = new Model\QuLang($db);
                    return new View\Helper\QuLangDetect($QuLang);
                },
                'QuNavigation'=>function($sm){
                    $Page = $sm->getServiceLocator()->get('QuNavigation');
                    return new View\Helper\QuNavView($Page);
                },
                'QuDoc' => function ($sm) {
                    $config = $sm->getServiceLocator()->get('config');
                    $QuDoc = new View\Helper\QuDoc($config['QuAdminConfig']['QuPhpThumb']);
                    return $QuDoc;
                },
                'QuLangUrl' => function ($sm) {
                    $Service = $sm->getServiceLocator();
                    $QuDoc = new View\Helper\QuLangUrl($Service);
                    return $QuDoc;
                },
            ),
        );

    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

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