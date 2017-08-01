<?php

namespace Acl\Form;

use Base\Form\FormAbstract;
use Zend\Form\Element\Submit;
use Zend\Form\Form,
    Zend\Form\Element\Select;

class Privilege extends FormAbstract{
    
    protected $roles;
    protected $resources;

    public function __construct($name = null, array $roles = null, array $resources = null) {
        parent::__construct($name);

        $this->roles = $roles;
        $this->roles['todos'] = 'todos os papeis';

        $this->resources = $resources;

        $this->setAttribute('role', 'form');
        $this->setAttribute('method', 'post');

        $this->setInputFilter((new \Acl\Form\Filter\Privilege())->getInputFilter());

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Privilégio: ")
                ->setAttribute('placeholder', "Entre com o nome")
                ->setAttribute('class', 'form-control')
                ->setAttribute('id', 'privilege_nome')
                ->setLabelAttributes(array('id' => 'label_privilege_nome'));
        $this->add($nome);
        
        $role = new Select();
        $role->setLabel("Papel: ")
                ->setName("role")
                ->setOptions(array(
                    'value_options' => $this->roles,
                    'empty_option' => ''
                )
            )
             ->setAttribute('class', 'form-control');
        $this->add($role);
        
        $resource = new Select();
        $resource->setLabel("Recurso: ")
                ->setName("resource")
                ->setOptions(array(
                    'value_options' => $this->resources,
                    'empty_option' => ''
                ))
                ->setAttribute('class', 'form-control');
        $this->add($resource);


        $submit = new Submit('submit');
        $this->add($submit);

    }

}
