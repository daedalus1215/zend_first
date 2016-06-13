<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Debug' => __DIR__ . '\..\view',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'timer' => 'Debug\Service\Factory\Timer'
        ),
        'initializers' => array(
            // The service initilizer will enable profiling for us. The code is saved as module/Debug/src/Debug/Service/Initializer/DbProfiler.php
            'Debug\Service\Initializer\DbProfiler'
        )
    ),
    'timer' => array (
        'times_as_float' => true,
    )
);
