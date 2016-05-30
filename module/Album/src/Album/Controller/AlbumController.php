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

use Album\Model\Album;          // <-- Add this import
use Album\Form\AlbumForm;       // <-- Add this import



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
    public function addAction() 
    {
        // We instantiate a new AlbumForm and grab it's submit element and set it's value to Add.
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');
        
        $request = $this->getRequest();
        
        // if the $request object has been posted we know we can do our work. We set the inputFilter from an album instance. 
        if ($request->isPost()) {
            $album = new Album();
            $form->setInputFilter($album->getInputFilter());
            
            // Set the data posted data to the form and check to see if it is valid using the isValid() method. 
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                // If valid we then grab the data from the form and store to the model using saveAlbum()
                $album->exchangeArray($form->getData());
                $this->getAlbumTable()->saveAlbum($album);
                
                // After saving the new Album row we redirect to the album page.
                
                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        // Finally we return an array - the form object, because it is the only thing we want to send to the view. We return an array containing variables to be assigned to the view and it will create a ViewModel behind the scenes for us. 
        return array('form' => $form);
    }
    
    // http://zendi/album/edit
    public function editAction() 
    {
        $id  = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'add',
            ));
        }
        
        
        // Get the Album with the specified id. An exception is thrown if it cannot be found, in which case go to the index page.
        try {
            $album = $this->getAlbumTable()->getAlbum($id);
        } 
        catch(\Exception $ex) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'index'
            ));    
        }
        
        $form = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $this->getAlbumTable()->saveAlbum($album);
                
                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        
        // This has not been posted, let's render the form
        return array(
            'id' => $id,
            'form' => $form,
        ); 
    }
    
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
