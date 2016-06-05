<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Debug\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'debug' => array(
              'type' => 'Literal',
              'options' => array(
                'route' => '/debug',
                'defaults' => array(
                  '__NAMESPACE__' => 'Debug\Controller',
                  'controller' => 'Index',
                  'action'     => 'index',
                ),
              ),
              'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ), 
          ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'timer' => 'Debug\Service\Factory\TimerAbstractFactory',
        ),
    ),
    'timers'          => array( // top-level config key for our abstract factory
        'timer' => array( //name of our service
            'times_as_float' => true,
            // and in the array we have the parameters to use for the service.
        ),
        'timer_non_float' => array( // name of our service.
            'times_as_float' => false, 
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Debug\Controller\Index' => 'Debug\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
          __DIR__.'/../view',
        ),
    ),
);