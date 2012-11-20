<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */
namespace QuPHPMailer;

use QuPHPMailer\Exception;

class Module
{
    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        $module = $this;
        return array(
            'factories' => array(
                'QuPHPMailer' => function () use ($module) {
                    return $module;
                },
            ),
        );
    }

    /**
     * @param bool $true
     *
     * @return \PHPMailer
     * @throws Exception\RuntimeException
     */
    public function Mail($true = true)
    {
        try
        {
            $Mail = new \PHPMailer($true);
        }
        catch (\Exception $e)
        {
            throw new Exception\RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
        return $Mail;
    }
}
