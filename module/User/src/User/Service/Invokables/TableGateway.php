<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Service\Invokables;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\TableGateway\TableGateway as DbTableGateway;

class TableGateway implements ServiceLocatorAwareInterface
{

  /**
   *
   * @var ServiceLocatorInterface
   */
  protected $serviceLocator;

  /**
   *
   * @var array
   */
  protected $cache;

  public function get($tableName, $features = null, $resultSetPrototype = null)
  {

    $cacheKey = $tableName; // cache stuff
    // $cacheKey = md5(serialize($tableName.$features.$resultSetPrototype));
    if (isset($this->cache[$cacheKey])) {
        return $this->cache[$cacheKey];
    }


    $config = $this->serviceLocator->get('config');
    // define which class should be used for which table
    $tableGatewayMap = $config['table-gateway']['map'];

    if (isset($tableGatewayMap[$tableName])) {
        $className = $tableGatewayMap[$tableName];
        $this->cache[$cacheKey] = new $className(); // cache stuff
    } else {
        $db = $this->serviceLocator->get('database');
        $this->cache[$cacheKey] = new DbTableGateway($tableName, $db, $features, $resultSetPrototype); // cache stuff
    }

    return $this->cache[$cacheKey];
  }


  public function getServiceLocator()
  {
    $this->serviceLocator;
  }

  public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
  {
    $this->serviceLocator = $serviceLocator;
  }

}