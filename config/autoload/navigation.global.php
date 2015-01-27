<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
// from http://framework.zend.com/manual/2.1/en/modules/zend.navigation.quick-start.html
// the array was empty before that
return array(
	'navigation' => array(
	    'default' => array(
	        array(
	            'label' => 'Home',
	            'route' => 'home',
	        ),
	        array(
                 'label' => 'Login', // 'Page #2',
                 'route' => 'auth-doctrine/default', // 'page-2',
				 'controller' => 'index',
				 'action'	=> 'login',
				 'resource'   => 'AuthDoctrine\Controller\Index', // 'mvc:admin',
				 'privilege'	=> 'login'
             ),
	        array(
                 'label' => 'Logout', // 'Page #2',
                 'route' => 'logout', // 'page-2',
				 'controller' => 'index',
				 'action'	=> 'logout',
				 'resource'   => 'AuthDoctrine\Controller\Logout', // 'mvc:admin',
				 'privilege'	=> 'logout'
             ),
	        array(
                 'label' => 'Register', // 'Page #2',
                 'route' => 'registration', // 'page-2',
				 'controller' => 'registration',
				 'action'	=> 'index',
				 'resource'   => 'AuthDoctrine\Controller\Registration', // 'mvc:admin',
				 'privilege'	=> 'registration'
             ),
	        array(
                 'label' => 'Verifications', // 'Page #2',
                 'route' => 'verifications', // 'page-2',
				 'controller' => 'Verifications',
				 'action'	=> 'index',
				 'resource'   => 'Verifications\Controller\Index', // 'mvc:admin',
				 'privilege'	=> 'verifications'
             ),
	    ),
	),
'service_manager' => array(
	    'factories' => array(
	        'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory', // <-- add this
	    ),
	),
);

/*
action	String	NULL	Action name to use when generating href to the page.
controller	String	NULL	Controller name to use when generating href to the page.
params	Array	array()	User params to use when generating href to the page.
route	String	NULL	Route name to use when generating href to the page.
routeMatch	Zend\Mvc\Router\RouteMatch	NULL	RouteInterface matches used for routing parameters and testing validity.
router	Zend\Mvc\Router\RouteStackInterface	NULL	Router for assembling URLs
*/