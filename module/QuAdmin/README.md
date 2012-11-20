QuAdmin
=======
Version 1.0.0 Created by Cel Ticó Petit

Screen Shots
------------

![QuDemo example screenshot](http://cenics.cat/quadmin1.png)
![QuDemo example screenshot](http://cenics.cat/quadmin2.png)

Requirements
------------

* [ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication)
* [ZfcBase](https://github.com/ZF-Commons/ZfcBase)
* [ZfcUser](https://github.com/ZF-Commons/ZfcUser)
* [WebinoImageThumb](https://github.com/webino/WebinoImageThumb)
* [CdliUserProfile](https://github.com/cdli/CdliUserProfile)
* [QuElFinder](https://github.com/Celtico/QuElFinder)
* [QuCKEditor](https://github.com/Celtico/QuCKEditor)
* [QuDemo](https://github.com/Celtico/QuDemo)


Installation
------------

* Drag the folder into modules folder or vendor folder
* Enable the module with the application.config.php, placing QuAdmin QuDemo and in last place
* Load table data folder in the database
* Move the public folder directory

See the [Zend\Db\Adapter](http://framework.zend.com/manual/2.0/en/modules/zend.db.adapter.html)
documentation for more info on how to configure the adapter for your specific database.

Configuring custom settings in QuDemo module
--------------------------------------------

Example:

```php
<?php

    // Your Dashboard
    'controllers' => array(
        'invokables' => array(
            'QuDashboard' => 'QuDemo\Controller\QuDashboard',
        ),
    ),
    'router' => array(
        'routes' => array(
            'demo' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/demo',
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
            'demo' => array(

                 // Your index dashboard
                'label' => 'Your QuDemo',
                'route' => 'demo',
                'pages' => array(

                    // Load PageEditors in sub menu QuAdmin
                    'TestDemo' => array(
                        'label' => 'Test demo',
                        'route' => 'demo/TestDemo',
                    ),
                    'TestDemo2' => array(
                        'label' => 'Test demo 2',
                        'route' => 'demo/TestDemo2',
                    ),
                    'Parameters' => array(
                        'label' => 'Parameters',
                        'route' => 'demo/Parameters',
                    ),
                    'Languages' => array(
                        'label' => 'Languages',
                        'route' => 'demo/Languages',
                    ),

                    // Load module in sub menu QuAdmin
                    'QuElFinder' => array(
                        'label' => 'File Manager',
                        'route' => 'demo/QuElFinder',
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
            //Recommended
            /*
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
            */
        ),
    ),

    //Config QuAdmin
    'QuAdminConfig' => array(

         // Control Layout Modules
         'QuLayout'=>array(
            'QuDemo'            =>'theme/layout/demo',
            'QuAdmin'           =>'theme/layout/demo',
            'QuElFinder'        =>'theme/layout/demo',
            'CdliUserProfile'   =>'theme/layout/demo',
            //Set layout login
            'ZfcUser'           =>'theme/layout/login',
            //Recommended
            //'CgmConfigAdmin'    =>'theme/layout/demo',

         ),

         // Control Base Path Modules
         'QuBasePath'=>array(
            'QuDemo'            =>'/qu-demo',
            'QuAdmin'           =>'/qu-demo',
            'QuElFinder'        =>'/qu-demo',
            'QuCKEditor'        =>'/qu-demo',
            'ZfcUser'           =>'/qu-demo',
            'CdliUserProfile'   =>'/qu-demo',
            //Recommended
             //'CgmConfigAdmin'    =>'/qu-demo',
         ),

         // Config QuPhpThumb
         'QuPhpThumb'=>array(
             'QuBasePath'       => dirname(dirname(dirname(__DIR__))) .'/web/uploads/files',
             'QuBaseURL'        =>'/uploads/files',
         ),

         // Config Redirect login
         'QuRedirectLogin'=>array(
            'QuDemo'            =>true,
            'QuAdmin'           =>true,
            'QuElFinder'        =>true,
            'QuCKEditor'        =>true,
            'ZfcUser'           =>true,
            'CdliUserProfile'   =>true,
             //'CgmConfigAdmin' =>true,
         ),

          // Template By Route Match
         'QuTemplate'=>array(
            'QuDemo'      => 'RouteMatch',
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
            'QuBasePath'=>'../qu-admin/js/plugins/elfinder',
        ),

        'QuCKEditor' => array(
            'QuBasePath' =>'/qu-admin/js/plugins/ckeditor',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

);
```