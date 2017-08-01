<?php

namespace Acl\Form;

use Base\Form\FormAbstract;
use Zend\Form\Element\Submit;
use Zend\Form\Form;

class Resource extends FormAbstract
{    
    public function __construct($name = null) 
    {
        parent::__construct('resources');
        
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');

        $this->setInputFilter((new \Acl\Form\Filter\Resource())->getInputFilter());

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Recurso: ")
                ->setAttribute('placeholder', "Entre com o recursor")
             ->setAttribute('class', 'form-control');
        $this->add($nome);

        $descricao = new \Zend\Form\Element\Textarea("descricao");
        $descricao->setLabel("Descricão: ")
            ->setAttribute('rows', 9)
            ->setAttribute('placeholder', "Descrição")
            ->setAttribute('class', 'form-control');
        $this->add($descricao);

        $submit = new Submit('submit');
        $this->add($submit);
    }

}
