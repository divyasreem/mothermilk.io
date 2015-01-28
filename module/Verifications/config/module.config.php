<?php
namespace Verifications;

return array(
	'controllers' => array(
        'invokables' => array(
            'Verifications\Controller\Index' => 'Verifications\Controller\IndexController',
        ),
    ),	
    'router' => array(
        'routes' => array(
            'verifications' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/verifications',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Verifications\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'paginator' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:controller/[page/:page]',
                            'constraints' => array(
                                'page' => '[0-9]*',
                            ),
                            'defaults' => array(
                               '__NAMESPACE__' => 'Verifications\Controller',
                                'controller'    => 'Index',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    'paginator-doctrine' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[page/:page]',
                            'constraints' => array(
                                'page' => '[0-9]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Verifications\Controller',
                                'controller'    => 'Index',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __NAMESPACE__ => __DIR__ . '/../view'
        ),
		
		'display_exceptions' => true,
    ),
    'doctrine' => array(
		
		// 2) standard configuration for the ORM from https://github.com/doctrine/DoctrineORMModule
		// http://www.jasongrimes.org/2012/01/using-doctrine-2-in-zend-framework-2/
		// ONLY THIS IS REQUIRED IF YOU USE Doctrine in the module
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
//            'my_annotation_driver' => array(
			__NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    // __DIR__ . '/../module/AuthDoctrine/src/AuthDoctrine/Entity' // 'path/to/my/entities',
					__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
					// 'H:\PortableApps\PortableGit\projects\btk\module\Auth\src\Auth\Entity' // Stoyan added to use doctrine in Auth module
//-					__DIR__ . '/../../Auth/src/Auth/Entity', // Stoyan added to use doctrine in Auth module
                    // 'another/path'
                ),
            ),

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    // 'My\Namespace' => 'my_annotation_driver'
					// 'AuthDoctrine' => 'my_annotation_driver'
					__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
//-					'Auth\Entity' => __NAMESPACE__ . '_driver' // Stoyan added to allow the module Auth also to use Doctrine
                )
            )
        )
    ),
);