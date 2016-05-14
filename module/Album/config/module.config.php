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
);
