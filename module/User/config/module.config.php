<?php
// Filename: /module/User/config/module.config.php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'user' => __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
      'factories' => array(
        // database object allows us to query the database and additionally escape parameter values.
        'database' => 'User\Service\Factory\Database'
      ),
    ),
    'controllers' => array(
        'invokables' => array(
           // below is key                      and below is the fully qualified class name
            'User\Controller\Account' => 'User\Controller\AccountController',
        ),
    ),
    'table-gateway' => array(
        'map' => array(
            'users' => 'User\Model\User',
        ),
    ),
    // This line opens the configuration for the RouteManager
    'router' => array(
        // Open configuration for all possible routes.
        'routes' => array(
            // Define a new route called 'user'
            'user' => array(
                // Define the routes type to be "Zend\Mvc\Router\Http\Literal", which is basically just a string
                'type'    => 'Literal',
                // Configure the route itself.
                'options' => array(
                    // Listen to /user as uri
                    'route'    => '/user',
                    // Define default controller and action to be called when this route is matched.
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Account',
                        'action'     => 'me',
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
    )
    );