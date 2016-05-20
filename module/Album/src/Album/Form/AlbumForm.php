<?php

namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form 
{
    public function __constructor($name = null) 
    {
        // we want to ignore the name passed
        parent::__contruct('album');
        
        
        
        /*
            The first thing we do is set the name of the form, as we call the parent's constructor. We create four form elements: the id, title, artist, and submit button. For each of the items we set various attributes and options, including the label to be displayed.
        
        */
        $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'title',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Title',
             ),
         ));
         $this->add(array(
             'name' => 'artist',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Artist',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }