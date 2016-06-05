<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Service\Factory;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Description of ControllerAbstractFactory
 *
 * @author larry
 */
class ControllerAbstractFactory implements AbstractFactoryInterface 
{
    
    
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        return class_exists($requestedName.'Controller');
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        $className = $requestedName.'Controller';
        $instance = new $className();
        return $instance;
    }

//put your code here
}
