<?php
return array(
    'modules' => array(

        //*** App
        'Application',

        //*** Your Webs
        'QuWebDemo',

        //*** QuModules Utilities
	    'QuElFinder',
        'QuCKEditor',
        'QuPHPMailer',


        //*** Extra Modules Provider
        'WebinoImageThumb',
        'ZfcBase',
        'ZfcUser',
        'CdliUserProfile',
        'CgmConfigAdmin',

        //*** QuModules Administrator
        'QuAdminDemo',
        'QuAdmin',

        //*** Security
        //'BjyAuthorize',
    ),

    //*** AutoLoader
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


