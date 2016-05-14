<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
    //section 1 - provides a list of all the controllers provided by the module. We will need one controller, AlbumController, which we'll reference as Album\Controller\Album. The controller key must be unique across all modules, so we prefix it with our module name.
    'controllers' => array(
        'invokables' => array(
            'Album\Controller\Album' => 'Album\Controller\AlbumController',
        ),
    ),
    //section 2 - we add our view directory to the TemplatePathStack configuration. This will allow it to find the view scripts for the Album module that are stored in our view/ directory.
    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),
    //section 3 - is new and should be added to your file - this route allows us to have the following URLS:
    /*
        /album              Home (list of albums)               index
        /album/add          Add new album                       add
        /album/edit/2       Edit album with an id of 2          edit
        /album/delete/4     Delete album with an id of 4 	delete
     */
    'router' => array(
        'routes' => array(
            //name of the route is 'album'
            'album' => array(
                //has a type of 'segment' 
                'type'    => 'segment',
                'options' => array(
                    //the segment route allows us to specify placeholders in the URL pattern (route) 
                    //that will be mapped to named parameters in the matched route. 
                    //In this case, the route --/album[/:action][/:id]-- 
                    //which will match any URL that starts with /album.
                    'route'       => '/album[:action][/:id]',
                    //constraints section allows us to ensure that the characters 
                    //within a segment are as expected, so we have limited actions 
                    //to starting with a letter and then subsequent characters only 
                    //being alphanumeric, underscore or hyphen. We also limit the id to a number.
                    'constraints' => array(
                      'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                      'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Album\Controller\Album',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    
);
