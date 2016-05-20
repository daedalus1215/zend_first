<?php

/* 
 * Album is an simple entity object.
 * 
 * This approach is to have model classes represent each entity in our application and then use mapper objects
 * that load and save entities to the database.
 * 
 * We could use other ORM tech, such as Doctrine or Propel.
 */



namespace Album\Model;


 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;




class Album implements InputFilterAwareInterface 
{
    public $id;
    public $artist;
    public $title;
    protected $inputFilter;                       // <-- Add this variable
    
    // In order to work with Zend\Db's TableGateway class, we need to implement
    // the exchangeArray() method. This method simply copies the data from the passed
    // in aray to our entity's properties.
    public function exchangeArray($data) 
    {
        $this->id       = (!empty($data['id'])) ? $data['id'] : null;
        $this->artist   = (!empty($data['artist'])) ? $data['artist'] : null;
        $this->title    = (!empty($data['title'])) ? $data['title'] : null;
    }
    
    
    
    /**
    The InputFilterAwareInterface defines two methods: setInputFilter() and getInputFilter(). We only need to implement getInputFilter() so we simply throw an exception in setInputFilter()
    
    Within getInputFilter we instantiate an InputFilter and then add the inputs that we require . We add one input for each property that we wish to filter or validate.
    
    Now we need to get the form to display and then process it on submission. This is done within the AlbumController's addAction().
    
    */
    
    // Add content to these methods
    public function setInputFilter(InputFilterInterface $inputFilter) 
    {
        throw new \Exception("not used");
    }
    
    public function getInputFilter() 
    {
 if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'artist',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'title',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }

