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
//        $eventManager = $e->getApplication()->getEventManager();
//        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'handleError'));
        
        $eventManager = $e->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        $sharedEventManager->attach('channel-25', 'new song', function(Event $event) {
            $artist = $event->getParam('artist');
            error_log('Got new song from artist:'.$artist);
            
        });
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
}