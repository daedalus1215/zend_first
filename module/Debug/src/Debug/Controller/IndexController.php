<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// testing

namespace Debug\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $serviceLocator = $this->getServiceLocator();
        $config = $serviceLocator->get('config');
        
        
        return array(
                    'version'=> $config['application']['version'],
                    'applicationName' => $config['application']['name']
                );
    }

    public function aboutAction()
    {
        return array();
    }
}