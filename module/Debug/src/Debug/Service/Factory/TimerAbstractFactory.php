<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Debug\Service\Factory;


use \Zend\ServiceManager\AbstractFactoryInterface;
use \Zend\ServiceManager\ServiceLocatorInterface;

use Debug\Service\Timer as TimerService;


/**
 * Description of TimerAbstractFactory
 *
 * @author larry
 */
class TimerAbstractFactory implements AbstractFactoryInterface
{

    /**
     * Configuration key holding timer configuration
     *
     * @var string
     */
    protected $configKey = 'timers';

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        $config = $serviceLocator->get('config');
        if (empty($config)) {
            return false;
        }
        return isset($config[$this->configkey][$requestedName]);
    }

    public function createServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        $config = $serviceLocator->get('config');
        $timer = new TimerService($config[$this->configKey][$requestedName]['times_as_float']);
        return $timer;
    }

}
