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

class Album 
{
    public $id;
    public $artist;
    public $title;
    
    // In order to work with Zend\Db's TableGateway class, we need to implement
    // the exchangeArray() method. This method simply copies the data from the passed
    // in aray to our entity's properties.
    public function exchangeArray($data) 
    {
        $this->id       = (!empty($data['id'])) ? $data['id'] : null;
        $this->artist   = (!empty($data['artist'])) ? $data['artist'] : null;
        $this->title    = (!empty($data['title'])) ? $data['title'] : null;
    }
}
