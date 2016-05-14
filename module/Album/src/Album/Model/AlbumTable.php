<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Album\Model;


 use Zend\Db\TableGateway\TableGateway;

class AlbumTable
{
    // Setup the protected property to the TableGateway instance passed in the 
    // constructor. we will use this to perform operations on the database 
    // table for our albums.
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) 
    {       
        $this->tableGateway = $tableGateway;
    }
    
    /*
     * Helper methods that our applciation will use to interface with the 
     * table gateway.
     */
    
    // retrieves all albums rows from the databaser as a ResultSet
    public function fetchAll() 
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    // retrieves a single row as an Album object.
    public function getAlbum($id) 
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
    
    // either creates a new row in the database or updates a row that already exists.
    public function saveAlbum(Album $album) 
    {
        $data = array(
            'artist' => $album->artist,
            'title' => $album->title,
        );
        
        $id = (int) $album->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAlbum($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Album id does not exist');
            }
        }
    }
    
    // removes the row commpletely.
    public function deleteAlbum($id) 
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}