<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */
return array(

    'controllers' => array(
        'invokables' => array(
            'QuCKEditor' => 'QuCKEditor\Controller\QuCKEditor',
        ),
    ),
    'router' => array(
        'routes' => array(
            'QuCKEditor' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/quckeditor',
                    'defaults' => array(
                        'controller' => 'QuCKEditor',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'QuConfig' => array(
        'QuCKEditor' => array(
            'QuBasePath' =>'/qu-admin/js/plugins/ckeditor',
            'QuElFinder' =>'/quelfinder/ckeditor',
            'QuElFinderConnector' =>'/quelfinder/connector',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);