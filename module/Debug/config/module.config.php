<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Debug' => __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'timer' => 'Debug\Service\Factory\Timer'
        ),
    ),
    'timer' => array (
        'times_as_float' => true,
    )
);
