<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

return array(


    // QuAdmin Navigation
    'navigation' => array(
        'qu_admin_navigation' => array(
            'test' => array(
                'icon'  => '&#xe001;',
                'label' => 'Inici',
                'route' => 'quadmin',
                'order' => -1,
                'pages' => array(
                ),
            ),

        ),
    ),


    // QuAdmin Strategy
    'QuAdminConfig' => array(


        // NAMESPACE Layout Module
        'QuLayout'=>array(
            'QuAdmin'           =>'qu-admin/layout/qu-admin-layout',
            'CdliUserProfile'   =>'qu-admin/layout/qu-admin-layout',
            'ZfcUser'           =>'qu-admin/layout/qu-admin-layout',
        ),

        'qu_admin_layout_login' => 'qu-admin/layout/qu-admin-login',


        // NAMESPACE Base Path Module
        'QuBasePath'=>array(
            'QuAdmin'           =>'/qu-admin',
            'ZfcUser'           =>'/qu-admin',
            'CdliUserProfile'   =>'/qu-admin',
        ),


        // NAMESPACE Redirect login
        'QuRedirectLogin'=>array(
            'QuAdmin'           =>true,
            //'ZfcUser'           =>true,
            'CdliUserProfile'   =>true,
        ),

        // QuFlashMessenger css
        'QuFlashMCss'=> 'alert',

    ),

);