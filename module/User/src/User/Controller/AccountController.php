<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use User\Form\User as UserForm;
use User\Model\User as UserModel;

class AccountController extends AbstractActionController
{
<<<<<<< HEAD
<<<<<<< HEAD
        public function indexAction()
    {
        return array();
    }
    public function addAction()
    {
        return array();
    }
    /*
   * Anonymous users can use this action to register new accounts
   */
    public function registerAction()
    {
        return array();
    }
    public function viewAction()
    {
        return array();
    }
    public function editAction()
    {
        return array();
    }
    public function deleteAction()
    {
        return array();
    }

=======
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
             $model = new UserModel();
             // getData() method will return an array of key/value pairs. The 
             // names of the table columns will be taken from the keys, and the 
             // values will be the value portions of the array.
             $id = $model->insert($form->getData());
             // @todo: redirect user to the view user action.
           }
       }

       // pass the data to the view for visualization.
       return array('form' => $form);
   }
   
   public function deleteAction()
   {
     $id = $this->getRequest()->getQuery()->get('id');
     if ($id) {
       $userModel = new UserModel();
       $userModel->delete(array('id' => $id));
     }
     
     return array();
   }
   
   
>>>>>>> b3214109f932b263586a4b0e121328c49c30cd05
}
=======


    /**
     * Create new User.
     * @return Array which contain's a Form object.
     */
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
                $curious = $form->getData();

                // save the data of the new user.
                $model = new UserModel();

                // getData() method will return an array of key/value pairs. The
                // names of the table columns will be taken from the keys, and the
                // values will be the value portions of the array.
                $id = $model->insert($form->getData());

                // redirect user to the view user action.
                return $this->redirect()->toRoute('user/default', array(
                    'controller' => 'account',
                    'action'     => 'view',
                    'id'         => $id,
                ));
            }
        }

        // pass the data to the view for visualization.
        return array('form' => $form);
    }


    /**
     * Delete a User.
     * @return Array
     */
    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery()->get('id');
        if ($id) {
            $userModel = new UserModel();
            $userModel->delete(array('id' => $id));
        }

        return array();
    }


    /**
     * Anonymous users can use this action to register new accounts
     * @return URL
     */
    public function registerAction()
    {
        $result = $this->forward()->dispatch('User\Controller\Account', array(
            'action' => 'add',
        ));

        return $result;
    }


    public function inAction()
    {
        if (!$this->getRequest()->isPost()) {
            // just show the login form.
            return array();
        }

        $username = $this->params()->fromPost('username');
        $password = $this->params()->fromPost('password');

        // @todo: When the authentication is implemented the hard-coded
        // value below has to be removed.
        $isValid = 1;
        if ($isValid) {
            $this->flashMessenger()->addSuccessMessage('You are now logged in.');
            return $this->redirect()->toRoute('user/default', array(
                'controller' => 'account',
                'action'     => 'me',
            ));
        } else {
            // @todo: report errors.
            $this->flashMessenger()->addErrorMessage('Sorry you failed to log in.');
        }

    }


}
>>>>>>> databse_profiler
