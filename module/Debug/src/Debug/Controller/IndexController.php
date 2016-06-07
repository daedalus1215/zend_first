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
        // layout will be our parent model
        $layoutViewModel = new ViewModel();
        // it must render view template with name 'layout/layout'
        $layoutViewModel->setTemplate('layout/layout');
        $viewModel = new ViewModel();
        $viewModel->setVariables(array(
        'version'=> $config['application']['version'],
        'applicationName' => $config['application']['name']
        ));
        $viewModel->setTemplate('application/index/about');
        // We add the view model as a child to the layout
        // The rendered content from the child model will be used
        // as value for the content variable
        $layoutViewModel->addChild($viewModel, 'content');
        return $layoutViewModel;
    }
}