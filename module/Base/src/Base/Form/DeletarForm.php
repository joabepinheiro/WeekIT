<?php
namespace Base\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;


class DeletarForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('role', 'form');


        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'result',
            'class'=> 'btn btn-add',
            'type' => 'Zend\Form\Element\Submit',
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }

}