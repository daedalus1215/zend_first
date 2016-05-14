<?php 
/**
 * This is our Module Manager
 * Laurence F Adams III
 * May 13 2016
 * Tutorial url: http://framework.zend.com/manual/current/en/user-guide/modules.html
 */
namespace Album;


use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * The ModuleManager will call getAutoloaderConfig() and getConfig() auto for us.
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface 
{
 /**
 *  
 * @return type array that is comptaible with ZF2's AutoloaderFactory. We configure it so that we add a class map to the ClassMapAutoloader and also add this module's namespace to the StandardAutoloader.
 */
  public function getAutoloaderConfig() 
  {
      return array(
          'Zend\Loader\ClassMapAutoloader' => array(
              __DIR__ . '/autoload_classmap.php',              
          ),
          'Zend\Loader\StandardAutoloader' => array(
              'namespaces' => array(
                  __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
              ),
          ),
      );
  }
  
  public function getConfig() 
  {
    return include __DIR__ . '/config/module.config.php';
  }

}