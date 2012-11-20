<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

return array(

    // Your Dashboard
    'controllers' => array(
        'invokables' => array(
            'QuDashboard' => 'QuAdminDemo\Controller\QuDashboard',
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin-demo' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/admin-demo',
                    'defaults' => array(
                        'lang'          => 'es',
                        'controller'    => 'QuDashboard',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(

                    // Load Editors in QuControllerFactory
                    'TestDemo' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route' => '[/:lang]/testdemo[/:action][/:id][/:id_parent]',
                            'constraints' => array(
                                'lang'      => '[a-z]{2}(-[A-Z]{2}){0,1}',
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'        => '[0-9]+',
                                'id_parent' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'lang'          => 'es',
                                'controller'    => 'QuAdminFactory',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    'TestDemo2' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route' => '[/:lang]/testdemo2[/:action][/:id][/:id_parent]',
                            'constraints' => array(
                                'lang'      => '[a-z]{2}(-[A-Z]{2}){0,1}',
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'        => '[0-9]+',
                                'id_parent' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'lang'          => 'es',
                                'controller'    => 'QuAdminFactory',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    'Languages' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route' => '/languages[/:action][/:id][/:id_parent]',
                            'constraints' => array(
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'        => '[0-9]+',
                                'id_parent' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'lang'          => '',
                                'controller'    => 'QuAdminFactory',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    'Parameters' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/parameters[/:action][/:id][/:id_parent]',
                            'constraints' => array(
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'        => '[0-9]+',
                                'id_parent' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'lang'          => '',
                                'controller'    => 'QuAdminFactory',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    //Load module in Sub menu QuAdmin
                    'QuElFinder' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/filemanager',
                            'defaults' => array(
                                'controller' => 'QuElFinder',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    // QuAdmin Navigation
    'navigation' => array(
        'QuNavigation' => array(
            'admin-demo' => array(

                 // Your index dashboard
                'label' => 'Your QuAdminDemo',
                'route' => 'admin-demo',
                'pages' => array(

                    // Load PageEditors in sub menu QuAdmin
                    'TestDemo' => array(
                        'label' => 'Test demo',
                        'route' => 'admin-demo/TestDemo',
                    ),
                    'TestDemo2' => array(
                        'label' => 'Test demo 2',
                        'route' => 'admin-demo/TestDemo2',
                    ),
                    'Parameters' => array(
                        'label' => 'Parameters',
                        'route' => 'admin-demo/Parameters',
                    ),
                    'Languages' => array(
                        'label' => 'Languages',
                        'route' => 'admin-demo/Languages',
                    ),

                    // Load module in sub menu QuAdmin
                    'QuElFinder' => array(
                        'label' => 'File Manager',
                        'route' => 'admin-demo/QuElFinder',
                    ),
                ),
            ),
            // Load module in menu QuAdmin
            'account' => array(
                'label' => 'My Profile',
                'route' => 'zfcuser/profile',
                'pages' => array(
                    'clau' => array(
                        'label' => 'My Profile',
                        'route' => 'zfcuser/profile',
                    ),
                    'logout' => array(
                        'label' => 'Logout',
                        'route' => 'zfcuser/logout',
                    ),
                ),
            ),
            'cgmconfigadmin' => array(
                'label' => 'Config Admin',
                'route' => 'cgmconfigadmin',
                'pages' => array(
                    'home' => array(
                        'label' => 'Config',
                        'route' => 'cgmconfigadmin',
                    ),
                ),
            ),

        ),
    ),

    //Config QuAdmin
    'QuAdminConfig' => array(

         // Control Layout Modules
         'QuLayout'=>array(
            'QuAdminDemo'       =>'theme/layout/admin-demo',
            'QuAdmin'           =>'theme/layout/admin-demo',
            'QuElFinder'        =>'theme/layout/admin-demo',
            'CdliUserProfile'   =>'theme/layout/admin-demo',
            'ZfcUser'           =>'theme/layout/login',
            'CgmConfigAdmin'    =>'theme/layout/admin-demo',

         ),

         // Control Base Path Modules
         'QuBasePath'=>array(
            'QuAdminDemo'       =>'/qu-admin-demo',
            'QuAdmin'           =>'/qu-admin-demo',
            'ZfcUser'           =>'/qu-admin-demo',
            'CdliUserProfile'   =>'/qu-admin-demo',
            'CgmConfigAdmin'    =>'/qu-admin-demo',
         ),

         // Config QuPhpThumb
         'QuPhpThumb'=>array(
             'QuBasePath'       => dirname(dirname(dirname(__DIR__))) .'/public/uploads/files',
             'QuBaseURL'        =>'/uploads/files',
         ),

         // Config Redirect login and set layout login
         'QuRedirectLogin'=>array(
            'QuAdminDemo'       =>true,
            'QuAdmin'           =>true,
            'QuElFinder'        =>true,
            'QuCKEditor'        =>true,
            'ZfcUser'           =>true,
            'CdliUserProfile'   =>true,
            'CgmConfigAdmin'    =>true,
         ),

          // Template By Route Match
         'QuTemplate'=>array(
            'QuAdminDemo' => 'RouteMatch',
            'QuAdmin'     => 'RouteMatch'
          ),

          // QuFlashMessenger css
         'QuFlashMCss'=> 'alert',
    ),

    //Config QuModules
    'QuConfig' => array(

        'QuElFinder'=>array(
            'QuRoots'=>array(
                'driver'        => 'LocalFileSystem',
                'path'          =>  dirname(dirname(dirname(__DIR__))) .'/public/uploads/files/',
                'URL'           =>  '/uploads/files/',
                'accessControl' => 'access'
            ),
            'QuBasePath'=>'/qu-admin-demo/js/plugins/elfinder',
        ),

        'QuCKEditor' => array(
            'QuBasePath' =>'/qu-admin-demo/js/plugins/ckeditor',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

);