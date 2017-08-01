<?php

namespace Base\Form;

use Zend\Form\Form;
use Zend\Form\Element;

abstract class FormAbstract extends Form {

    public function __construct($_name = null) {
        parent::__construct($_name);
    }

    public function editingMode(){

    }

}
