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

use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

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

  /*
   * This method returns an array of factories that are all merged 
   * together by the ModuleManager before passing them to the ServiceManager. 
   */
  public function getServiceConfig() 
  {
      return array(
          'factories' => array(
            /* The factory for Album\Model\AlbumTable uses the ServiceManager to 
             * create an AlbumTableGateway to pass to the AlbumTable. 
             */
            'Album\Model\AlbumTable' => function ($sm) {
                $tableGateway = $sm->get('AlbumTableGateway');
                $table = new AlbumTable($tableGateway);
                return $table;
              },
                      
            /* Tell the ServiceManager that an AlbumTableGateway is created by 
             * getting a Zend\Db\Adapter\Adapter (also from the ServiceManager)
             * and using it to create a TableGateway object. 
             * 
             * The TableGateway is told to use an Album object whenever it creates 
             * a new result row. The TableGateway classes use the protoype pattern 
             * for creation of result sets and entities. 
             * 
             * This means that instead of instantiating when required, the system 
             * clones a previously instantiated object.
             */
            'AlbumTableGateway' => function ($sm) {
                  $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                  $resultSetPrototype = new ResultSet();
                  $resultSetPrototype->setArrayObjectPrototype(new Album());
                  return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
            },
          ),
      );
  }
}