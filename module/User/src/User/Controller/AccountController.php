<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use User\Form\User as UserForm;

class AccountController extends AbstractActionController
{
   public function addAction()
   {
       $form = new UserForm();

       if ($this->getRequest()->isPost()) {
           // notice: make certain to merge the Files also to the post data.
           $data = array_merge_recursive(
                   $this->getRequest()->getPost()->toArray(),
                   //The post data will contain all post parameters except the file uploads. In order to get them from the request we have to use getFiles().
                   $this->getRequest()->getFiles()->toArray()
            );

           $form->setData($data);

           if ($form->isValid()) {
               // @todo: save the data of the new user.
           }
       }

       // pass the data to the view for visualization.
       return array('form1' => $form);
   }
}