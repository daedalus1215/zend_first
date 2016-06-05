<?php

/**
 * This is the factory of Timer.php at location /Debug/Service/Timer.php
 */

namespace Debug\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Debug\Service\Factory\Timer as TimerService;

class Timer implements FactoryInterface
{
    
    public function createService(ServiceLocatorInterface $serviceLocator) 
    {
        $config = $serviceLocator->get('config');        
        $timer = new TimerService($config['timer']['times_as_float']);
        return $timer;
    }
    
    
    public function get($name) {
        
    }

    public function has($name) {
        
    }

}
