<?php

/* 
 * Controller is a class that is generally called {Controllername}Controller. This class lives in a file
 * called {Controller name}Controller.php within the Controller directory of the module. 
 * In our case that is module/Album/src/Album/Controller.
 * Each action is a public method within the controller class that is named {action name}Action.
 */
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AlbumController extends AbstractActionController 
{
    
    /* These are the 4 actions that we want to use. */
    
    // http://zendi/album
    public function indexAction() {} 
    
    // http://zendi/album/add
    public function addAction() {}
    
    // http://zendi/album/edit
    public function editAction() {}
    
    // http://zendi/album/delete
    public function deleteAction() {}
    
}

/**
 * To Note: 
 * We must make sure we register the new Album module in the "modules" section of our config/application.config.php 
 * You also have to provide a Module Class for the album module to be recognized by the MVC
 * 
 * We have already informed the module about our controller in the 'controller' section
 * of module/Album/config/module.config.php
 */
