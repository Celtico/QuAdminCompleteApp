<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

    /* php vendor/zf2/bin/classmap_generator.php -l ./module/QuPHPMailer/src/PHPMailer/ -o ./module/QuPHPMailer/autoload_classmap.php
     * Ftp
     * User: bvland
     * Password: SNyU68tp
     * Host: ftp.bvland.com.mialias.net
     *
     * Mysql
     * User: mybvland
     * Password: 9puLs2Ua
     * Host: localhost
     * db: bvland
    */
return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn'            => 'mysql:dbname=quadmin;hostname=localhost',
        'username'       => 'root',
        'password'       => 'estacio8',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);