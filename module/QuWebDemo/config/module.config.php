<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */
return array(

    'controllers' => array(
        'invokables' => array(
            'QuWebDemo' => 'QuWebDemo\Controller\ContentController'
        ),
    ),

    'router' => array(
        'routes' => array(
            'web-demo' => array(
                'type' => 'segment',
                //** Added domain for your web */
                //'type' => 'hostname',
                'priority' => 1000,
                'options' => array(
                    'route' => '/web-demo[/:lang][/:url][/:url2][/:id]',
                    //** Added domain for your web */
                    //'route' => 'web-demo.com',
                    'defaults' => array(
                        'lang'          => 'es',
                        'controller'    => 'QuWebDemo',
                        'action'        => 'action',
                        'url'           => 'home',
                    ),
                ),
            ),
        ),
    ),


    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'QuAdminConfig' => array(

        // Control Layout Modules
        'QuLayout'=>array(
            'QuWebDemo'         =>'layout/qu-web-demo',
        ),

        // Control Base Path Modules
        'QuBasePath'=>array(
            'QuWebDemo'         =>'/qu-web-demo',
        ),
    ),

    // CgmConfigAdmin good module!!!
    'cgmconfigadmin' => array(
        'config_groups' => array(
            'site' => array(
                'QuWebDemo' => array('label' => 'QuWebDemo',  'sort' =>-101),
            ),
        ),
        'config_options' => array(
            'site' => array(

                'QuWebDemo' => array(
                    'email'           => array(
                        'input_type'  => 'text',
                        'label'       => 'E-mail',
                    ),
                    'name'             => array(
                        'input_type'  => 'text',
                        'label'       => 'Name',
                    ),
                    'address'          => array(
                        'input_type'  => 'textarea',
                        'label'       => 'Address',
                    ),
                    'link' => array(
                        'input_type'    => 'text',
                        'label'         => 'Link',
                    ),
                    'host'             => array(
                        'input_type'   => 'text',
                        'label'        => 'Host',
                    ),
                    'username'          => array(
                        'input_type'   => 'text',
                        'label'        => 'User',
                    ),
                    'password' => array(
                        'input_type'   => 'password',
                        'label'        => 'Password',
                    ),
                ),

            ),
        ),
    ),
);
