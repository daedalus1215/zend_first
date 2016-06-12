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
  
  
  protected $serviceLocator;
  
  public function get($tableName, $features = null, $resultSetPrototype = null) 
  {
    $db = $this->serviceLocator->get('database');
    
    $tableGateway = new DbTableGateway($tableName, $db, $features, $resultSetPrototype);
    return $tableGateway;
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