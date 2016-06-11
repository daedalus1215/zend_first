<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Form;

// Form library
use Zend\Form\Form;
// Input libraries
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;

use Zend\InputFilter\InputFilterInterface;

class User extends Form
{

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception('It is not allowed to set the input filter');
    }


    public function __construct()
    {
        parent::construct();

        $this->setAttribute('method', 'post');

        setupEmailField();

        setupPasswordFields();

        setupNameField();

        setupPhoneField();

        setupAutomationProtection();

        setupSubmitField();
    }








    /* UTILITY FUNCTIONS - essentially InputField creators. */

    public function setupEmailField()
    {
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
    }

    public function setupPasswordFields()
    {
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
    }

    public function setupNameField()
    {
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
    }

    public function setupPhoneField()
    {
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
    }

    public function setupFileField()
    {
        // Define File upload (for picture) field.
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

    public function setupAutomationProtection()
    {
        // This is the special code that protects our form from being submitted from automated scripts
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf'
        ));
    }

    public function setupSubmitField()
    {
        // This is the submit button
        $this->add(array(
            'name'       => 'Submit',
            'type'       => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value'    => 'Submit',
                'required' => 'false',
            ),
        ));
    }





    // InputFilter functionality
    public function getInputFilter()
    {
        if (!$this->filter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            applyEmailAddressFilter($inputFilter, $factory);

            applyNameFilter($inputFilter, $factory);

            applyPasswordFilter($inputFilter, $factory);

            applyPhotoFilter($inputFilter, $factory);

            applyPhoneFilter($inputFilter, $factory);

            $this->filter = $inputFilter;
        }
        return $this->filter;
    }


   /* UTILITY FUNCTIONS - the application of filters on the afor-instantiated fields. */
   public function applyEmailAddressFilter($inputFilter, $factory)
   {
       // Make sure the Email Address is a proper email address.
        $inputFilter->add($factory->createInput(array(
            'name'       => 'email',
            'filters'    => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                ),
            ),
            'validators' => array(
                array(
                    'name'     => 'EmailAddress',
                    'options'  => array(
                        'messages' => array(
                            'emailAddressInvalidFormat' => 'Email address format is not valid'
                        )
                    ),
                ),
                array(
                    'name'     => 'NotEmpty',
                    'options'  => array(
                        'messages' => array(
                            'isEmpty'                   => 'Email address is required'
                        )
                    )
                )
            ),
        )));
   }


   public function applyNameFilter($inputFilter, $factory)
   {
       $inputFilter->add($factory->createInput(array(
           'name' => 'name',
           'filters' => array(
               array(
                   'name' => 'StripTags'
               ),
               array(
                   'name' => 'StringTrim'
               )
           ),
           'validators' => array(
               array(
                   'name' => 'NotEmpty',
                   'options' => array(
                       'messages' => array(
                           'isEmpty' => 'Name is required'
                       )
                   )
               )
           )
       )));
   }

   public function applyPasswordFilter($inputFilter, $factory)
   {
       $inputFilter->add($factory->createInput(array(
           'name' => 'password_verify',
           'filters' => array(
               array(
                   'name' => 'StripTags'
               ),
               array(
                   'name' => 'StringTrim'
               ),
           ),
           'validators' => array(
               'name'     => 'identical',
               'options'  => array(
                   'token' => 'password'
               )
           )
       )));
   }

   public function applyPhotoFilter($inputFilter, $factory)
   {
       $inputFilter->add($factory->createInput(array(
           'name' => 'photo',
           'validators' => array(
               array(
                   'name' => 'filesize',
                   'options' => array(
                       'max' => 2097152, // 2 MB
                   ),
               ),
               array(
                   'name' => 'filemimetype',
                   'options' => array(
                       'mimeType' => 'image/png, image/x-png, image/jpg, image/jpeg, image/gif',
                   ),
               ),
               array(
                   'name'    => 'fileimagesize',
                   'options' => array(
                       'maxWidth'  => 200,
                       'maxHeight' => 200
                   )
               )
           ),
           'filters' => array(
               array(
                   'name' => 'filerenameupload',
                   'options' => array(
                       'target' => 'data/image/photos/',
                       'randomize' => true,
                   )
               )
           ),
       )));
   }

   public function applyPhoneFilter($inputFilter, $factory)
   {
       $inputFilter->add($factory->createInput(array(
           'name' => 'phone',
           'filters' => array(
               array(
                   'name' => 'digits'
               ),
               array(
                   'name' => 'stringtrim'
               ),
           ),
           'validators' => array(
               array(
                   'name' => 'regex',
                   'options' => array(
                       'pattern' => '/^[\d-V]+$/',
                   )
               )
           ),
       )));
   }

}