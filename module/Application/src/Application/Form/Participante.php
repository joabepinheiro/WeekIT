<?php

namespace Application\Form;

use Base\Form\FormAbstract;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Form\Element\ObjectSelect;
use Zend\Form\Element;

class Participante extends FormAbstract{

    public function __construct($_name = null){
        parent::__construct($_name);

        $this->setInputFilter((new Filter\Participante())->getInputFilter());

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'nome',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Nome',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Nome',
            ),
        ));


        $this->add(array(
            'name' => 'sobrenome',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Sobrenome',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Sobrenome',
            ),
        ));

        $this->add(array(
            'name' => 'cpf',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control cpf',
                'placeholder' => 'Cpf',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Cpf',
            ),
        ));


        $this->add(array(
            'name' => 'instituicao',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'id'    => 'instituicao',
                'placeholder' => 'Instituição'
            ),
            'options' => array(
                'label' => 'Instituição',
            ),
        ));



        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sexo',
            'attributes' =>  array(
                'id' => 'sexo',
                'options' => array(
                    '' => '',
                    'masculino' => 'Masculino',
                    'feminino' => 'Feminino',
                ),
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Sexo',
            ),
        ));

        $this->add(array(
            'name' => 'telefone1',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Telefone 1'
            ),
            'options' => array(
                'label' => 'Telefone 1',
            ),
        ));

        $this->add(array(
            'name' => 'telefone2',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Telefone 2'
            ),
            'options' => array(
                'label' => 'Telefone 2',
            ),
        ));

        $this->add(array(
            'name' => 'campus',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Campus'
            ),
            'options' => array(
                'label' => 'Campus',
            ),
        ));


        $this->add(array(
            'name' => 'curso',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Curso'
            ),
            'options' => array(
                'label' => 'Curso',
            ),
        ));


        $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array(
                'class'         => 'form-control',
                'placeholder'   => 'Email',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));


        $this->add(array(
            'name' => 'senha',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'class'         => 'form-control',
                'placeholder'   => 'Senha',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Senha',
            ),
        ));


        $this->add(array(
            'name' => 'confirmarsenha',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder'   => 'Comfirmar senha',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Confirmar Senha',
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
        ));
    }

    public function editingMode(){
        $this->get('senha')->setLabel('Nova senha');
        $this->get('senha')->setAttribute('required' , false);

        $this->get('confirmarsenha')->setLabel('Confirmar nova senha');
        $this->get('confirmarsenha')->setAttribute('required' , false);

        $this->getInputFilter()->get('senha')->setRequired(false);
        $this->getInputFilter()->get('confirmarsenha')->setRequired(false);
    }
}