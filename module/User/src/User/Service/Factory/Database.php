<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Di\ServiceLocator;

class Database implements FactoryInterface
{
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->getConfig('config');
        $adapter = new DbAdapter($config['db']);
        return $adapter;
    }

}