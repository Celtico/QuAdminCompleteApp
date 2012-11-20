<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

return array(
    'controllers' => array(
        'factories' => array(
            'QuAdminFactory' => 'QuAdmin\Controller\QuAdminFactory',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'QuNavigation' => 'QuAdmin\Service\QuNavigation',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'QuActive'     => 'QuAdmin\View\Helper\QuActive',
            'QuAccordion'  => 'QuAdmin\View\Helper\QuAccordionForm',
        ),
    ),
    // Config Translator
    'translator' => array(
        'locale' => 'en',
        'translation_file_patterns' => array(
            array(
                'type'     => 'phparray',
                'base_dir' => __DIR__ . '/../lang',
                'pattern'  => '%s.php',
            ),
        ),
    ),
);