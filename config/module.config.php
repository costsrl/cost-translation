<?php

namespace CostTranslation;

use Zend\ServiceManager\Factory\InvokableFactory;
use CostTranslation\View\Helper\LanguageMenuFactory;
/**
 * ZF2 Plugin Config file
 *
 * This file contains all the configuration for the Module as defined by ZF2.
 * See the docs for ZF2 for more information.
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 */

return array(
    'controllers' => array(
        'factories' => array(
            Controller\IndexController::class => \Controller\Factory\IndexControllerFactory::class
        )
    ),
    /**
     * Can be removed after ZF2 PR
     */
    'service_manager' => array(
        'factories' => array(
            'CostTranslation\DbLoader' => \CostTranslation\Factory\LoaderFactory::class,
            \Laminas\I18n\Translator\TranslatorInterface::class => \CostTranslation\Factory\TranslatorFactory::class,

        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        "remote_translation" => [
            ['type' => 'CostTranslation\DbLoader', "text_domain" => "db", 'entity' => 'CostTranslation\Entity\Message']
        ]
    ),
    'translator_loaders' => array(
        'factories' => array(
            'CostTranslation\DbLoader' => \CostTranslation\Factory\LoaderFactory::class,
        )
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
    'view_helpers' => [
        'factories' => [
            View\Helper\LanguageMenu::class =>LanguageMenuFactory::class,
            
        ],
        'aliases' => [
            'menulanguage' => View\Helper\LanguageMenu::class,
        ],
    ],
    'router' => array(
        'routes' => array(
            'switch-language' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/switch-language',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        'controller' => Controller\IndexController::class,
                        'action' => 'switchlanguage'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:language[/:redirect]]',
                            'constraints' => array(),
                            'defaults' => array(
                                'controller' => Controller\IndexController::class,
                                'action' => 'switchlanguage',
                                'language' => 'en_US',
                                'redirect' => 'home'
                            )
                        )
                    )
                )
            )
        )
    ),
);