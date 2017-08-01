<?php

namespace Acl\Form;

use Base\Form\FormAbstract;
use Zend\Form\Element\Submit;
use Zend\Form\Form,
    Zend\Form\Element\Select;

class Role extends FormAbstract{

    protected $parent;

    public function __construct($name = null, array $parent) {
        parent::__construct('roles');

        $this->parent  = $parent;

        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');

        $this->setInputFilter((new \Acl\Form\Filter\Role())->getInputFilter());

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Nome: ")
                ->setAttribute('placeholder', "Entre com o nome")
                    ->setAttribute('class', 'form-control');
        $this->add($nome);

        $descricao = new \Zend\Form\Element\Textarea("descricao");
        $descricao->setAttribute('rows', 9);
        $descricao->setLabel("Descrição: ")
            ->setAttribute('placeholder', "Descrição")
            ->setAttribute('class', 'form-control');
        $this->add($descricao);

        $parent = new Select('parent');
        $parent->setLabel("Herança: ")
                ->setOptions(array(
                    'value_options' => $this->parent,
                    'empty_option' => 'Nenhum'
                    ))
                ->setAttribute('class', 'form-control');
        $this->add($parent);

        $submit = new Submit('submit');
        $this->add($submit);
    }
}
