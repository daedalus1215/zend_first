<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\ModuleEvent;
use Zend\EventManager\Event;
use Zend\EventManager\EventManager;

class Module implements AutoloaderProviderInterface 
{
    public function getAutoloaderConfig() {
        
    }

    
    public function init(ModuleManager $moduleManager) 
    {
        $eventManager = $moduleManager->getEventManager();
        $eventManager->attach(ModuleEvent::EVENT_LOAD_MODULES_POST, array($this, 'loadedModulesInfo'));        
    }
    
    public function loadedModulesInfo(Event $event) 
    {
        $moduleManager = $event->getTarget();
        $loadedModules = $moduleManager->getLoadedModules();
        error_log(var_export($loadedModules, true));
    }
    
    
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR
                            , array($this, 'handleError'));
        
        // Access the ServiceManager
        $serviceManager = $e->getApplication()->getServiceManager();
        // Here we start the timer
        $timer = $serviceManager->get('timer');
        $timer->start('mvc-execution');
        
        
        // attach listener to the finish event that has to be executed with priority 2
        // The priority here is 2 because listeners with the priority will be executed just before the 
        // actual finish event is triggered.
        $eventManager->attach(MvcEvent::EVENT_FINISH
                            , array($this, 'getMvcDuration')
                            , 2);
    }
    
 
    public function handleError(MvcEvent $e)
    {
        $controller = $e->getController();
        $error = $e->getParam('error');
        $exception = $e->getParam('exception');
        $message = sprintf('Error dispatching controller "%s". Error was "%s"', $controller, $error);
        if ($exception instanceof \Exception) {
            $exception->getTraceAsString();
        }
        
        error_log($message);
    }  
    
    public function getMvcDuration(MvcEvent $event) 
    {
        // Here we get the ServiceManager.
        $serviceManager = $event->getApplication()->getServiceManager();
        // Get the already created instance of our timer service.
        $timer = $serviceManager->get('timer');
        $duration = $timer->stop('mvc-execution');
        // finally print the duration
        error_log('MVC Duration: ' . $duration . ' seconds');
    }
}