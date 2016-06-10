<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Form;

use Zend\Form\Form;

class User extends Form
{
    public function __construct()
    {
        parent::construct();

        
        $this->setAttribute('method', 'post');
        
        
        
        // Define email element field.
        $this->add(array(
            'name'       => 'email', // unique name of the element
            'type'       => 'Zend\Form\Element\Email', // Must be a valid Zend Form element.
            'options'    => array(
                // List of options that we can add to the element.
                'label'         => 'Email:'
            ),
            'attributes' => array(
                // These are the attributes that are passed directly to the HTML element
                'type'          => 'email',
                'required'      => 'required',
                'placeholder'   => 'Email Address',
            ),
        ));

        // Define a phone element field
        $this->add(array(
            'name'       => 'phone',
            'options'    => array(
                'label'     => 'Phone number'
            ),
            'attributes' => array(
                // Below: HTML5 way to specify that thei nput will be a phone number
                'type'      => 'tel',
                'required'  => 'required',
                'pattern'   => '^[\d-/]+$',
            ),
        ));
        
        // Define password field
        $this->add(array(
          'name'       => 'password',
          'type'       => 'Zend\Form\Element\Password',
          'attributes' => array(
            'placeholder' => 'Password',
            'required'    => 'required',
          ),
          'options'    => array(
            'label'       => 'Password',
          ),
        ));

        // Define verify password field
        $this->add(array(
          'name'       => 'password_verify',
          'type'       => 'Zend\Form\Element\Password',
          'attributes' => array(
            'placeholder' => 'Verify Password Here',
            'required' => 'required',
          ),
          'options'    => array(
            'label'       => 'Verify Password',
          ),
        ));
        
        // Define name field
        $this->add(array(
          'name'       => 'name',
          'type'       => 'Zend\Form\Element\Text',
          'attributes' => array(
            'placeholder' => 'Type name',
            'required'    => 'required',
          ),
          'options'    => array(
            'label'       => 'Name',
          ),
        ));
        
        
        $this->add(array(
          'name'       => 'phone',
          'options'    => array(
            'label'   => 'Phone number'
          ),
          'attributes' => array(
            'type'    => 'tel',
            'required'=> 'required',
            'pattern' => '^[\d-/]+$'
          ),
        ));
        
        
        $this->add(array(
          'type'       => 'Zend\Form\Element\File',
          'name'       => 'photo',
          'options'    => array(
            'label'     => 'Your photo'
          ),
          'attributes' => array(
            'required'  => 'required',
            'id'        => 'photo',
          ),
        ));
        
        
    }
}