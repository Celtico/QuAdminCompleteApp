<?php
return array(
    'modules' => array(

        //Zend Skeleton Application
        'Application',

        //Providers
        'CgmConfigAdmin',
        'ZfcBase',
        'ZfcUser',
        'CdliUserProfile',
        'WebinoImageThumb',

        //Qu providers
        'QuPlupload',
        'QuElFinder',
        'QuCKEditor',
        'QuPHPMailer',
        'QuTcPdf',
        'QuIcoMoon',

        //Qu developed
        'QuSystem',
        'QuWebDemo',
        'QuAdminDemo',
        'QuAdmin',

    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);