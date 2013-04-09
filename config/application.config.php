<?php
return array(
    'modules' => array(
        'Application',

        'CgmConfigAdmin',
        'ZfcBase',
        'ZfcUser',
        'CdliUserProfile',

        'QuPlupload',
        'QuElFinder',
        'QuCKEditor',
        'QuPHPMailer',
        'QuTcPdf',
        'WebinoImageThumb',

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
