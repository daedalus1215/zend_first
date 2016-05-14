<?php

/* 
 * Controller is a class that is generally called {Controllername}Controller. This class lives in a file
 * called {Controller name}Controller.php within the Controller directory of the module. 
 * In our case that is module/Album/src/Album/Controller.
 * Each action is a public method within the controller class that is named {action name}Action.
 * 
 * continue from: http://framework.zend.com/manual/current/en/user-guide/database-and-models.html
 */
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AlbumController extends AbstractActionController 
{
    protected $albumTable;
    
    /* These are the 4 actions that we want to use. */
    
    
    public function indexAction() {
        // In order to list the albums, we need to retrieve them from the model 
        // and pass them to the view. To do this, we fill in indexAction() 
        // within AlbumController. Update the AlbumController's indexAction() 
        // like this:
        return new ViewModel(array(
            'albums' => $this->getAlbumTable()->fetchAll(),
        ));
    } 
    
    // http://zendi/album/add
    public function addAction() {}
    
    // http://zendi/album/edit
    public function editAction() {}
    
    // http://zendi/album/delete
    public function deleteAction() {}
    
    // Now that the ServiceManager can create an AlbumTable instance for us, 
    // we can add a method to the controller to retrieve it. Add getAlbumTable() to the AlbumController class:
    public function getAlbumTable() 
    {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');            
        }
        return $this->albumTable;
    }
    
}

/**
 * To Note: 
 * We must make sure we register the new Album module in the "modules" section of our config/application.config.php 
 * You also have to provide a Module Class for the album module to be recognized by the MVC
 * 
 * We have already informed the module about our controller in the 'controller' section
 * of module/Album/config/module.config.php
 */
