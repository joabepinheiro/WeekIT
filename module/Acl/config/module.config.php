<?php

namespace Acl;

return array(
    'router' => array(
        'routes' => array(
            'acl-privileges' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/acl/privilegio',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Acl\Controller',
                        'controller'    => 'Privileges',
                        'action'        => 'index',
                        'module'        => 'Acl'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Acl\Controller',
                                'controller'    => 'Privileges',
                            )
                        ),
                    ),
                ),
            ),
            'acl-resources' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/acl/recurso',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Acl\Controller',
                        'controller'    => 'Resources',
                        'action'        => 'index',
                        'module'        => 'Acl'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Acl\Controller',
                                'controller'    => 'Resources',
                            )
                        ),
                    ),
                ),
            ),
            'acl-roles' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/acl/papel',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Acl\Controller',
                        'controller'    => 'Roles',
                        'action'        => 'index',
                        'module'        => 'Acl'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Acl\Controller',
                                'controller'    => 'Roles',
                            )
                        ),
                    ),
                ),
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'Acl\Controller\Roles' => 'Acl\Controller\RolesController',
            'Acl\Controller\Resources' => 'Acl\Controller\ResourcesController',
            'Acl\Controller\Privileges' => 'Acl\Controller\PrivilegesController',
        )
    ),

    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),

    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
                'pages' => array(
                    array(
                        'label'  => 'Privilégios',
                        'route'  => 'acl-privileges/default',
                        'action' => 'index',
                        'pages'  => array(
                            array(
                                'label'  => 'Cadastar',
                                'route'  => 'acl-privileges/default',
                                'action' => 'cadastrar',
                            ),
                            array(
                                'label' => 'Editar',
                                'route' => 'acl-privileges/default',
                                'action' => 'editar',
                            ),
                            array(
                                'label' => 'Listar',
                                'route' => 'acl-privileges/default',
                                'action' => 'index',
                            ),

                            array(
                                'label' => 'Deletar',
                                'route' => 'acl-privileges/default',
                                'action' => 'deletar',
                            ),
                        )
                    ),
                    array(
                        'label'  => 'Recursos',
                        'route'  => 'acl-resources/default',
                        'action' => 'index',
                        'pages'  => array(
                            array(
                                'label'  => 'Cadastar',
                                'route'  => 'acl-resources/default',
                                'action' => 'cadastrar',
                            ),
                            array(
                                'label' => 'Editar',
                                'route' => 'acl-resources/default',
                                'action' => 'editar',
                            ),
                            array(
                                'label' => 'Listar',
                                'route' => 'acl-resources/default',
                                'action' => 'index',
                            ),

                            array(
                                'label' => 'Deletar',
                                'route' => 'acl-resources/default',
                                'action' => 'deletar',
                            ),
                        )
                    ),
                    array(
                        'label'  => 'Papéis',
                        'route'  => 'acl-roles/default',
                        'action' => 'index',
                        'pages'  => array(
                            array(
                                'label'  => 'Cadastar',
                                'route'  => 'acl-roles/default',
                                'action' => 'cadastrar',
                            ),
                            array(
                                'label' => 'Editar',
                                'route' => 'acl-roles/default',
                                'action' => 'editar',
                            ),
                            array(
                                'label' => 'Listar',
                                'route' => 'acl-roles/default',
                                'action' => 'index',
                            ),

                            array(
                                'label' => 'Deletar',
                                'route' => 'acl-roles/default',
                                'action' => 'deletar',
                            ),
                        )
                    ),
                ),
            ),
        ),
    ),

    'module_layouts' => array(
        'Acl' => 'layout/acl',
    ),

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/acl'        => __DIR__ . '/../view/layout/acl.phtml',
            'error/404'         => __DIR__ . '/../view/error/404.phtml',
            'error/index'       => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        )
    ),

    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),

    'fixture' => array(
        'Acl_fixture' => __DIR__ . '/../src/Acl/Fixture',
    ),
);