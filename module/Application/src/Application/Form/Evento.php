<?php

namespace Application\Form;

use Base\Form\FormAbstract;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Form\Element\ObjectSelect;
use Zend\Form\Element;

class Evento extends FormAbstract{

    protected $entityManager;

    public function __construct($_name = null, EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct($_name);

        $this->setInputFilter((new Filter\Evento())->getInputFilter());

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'identificador',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Identificador'
            ),
            'options' => array(
                'label' => 'Identificador',
            ),
        ));

        $this->add(array(
            'name' => 'titulo',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Título'
            ),
            'options' => array(
                'label' => 'Título',
            ),
        ));

        $this->add(array(
            'name' => 'inicio',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control data_evento',
                'placeholder' => 'Início'
            ),
            'options' => array(
                'label' => 'Início',
            ),
        ));

        $this->add(array(
            'name' => 'fim',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control data_evento',
                'placeholder' => 'Fim'
            ),
            'options' => array(
                'label' => 'Fim',
            ),
        ));

        $palestrante = new ObjectSelect('palestrante');
        $palestrante->setOptions(array(
                'label' => 'Palestrante',
                'object_manager'     => $entityManager,
                'target_class'       => 'Application\Entity\Palestrante',
                'is_method' => true,
                'display_empty_item' => true,
                'find_method'        => array(
                    'name'   => 'findAll',
                )
            )
        )
            ->setAttribute('class', 'select2-multiple')
            ->setAttribute('multiple', 'multiple');
        $palestrante->setValue(0);
        $this->add($palestrante);

        $local = new ObjectSelect('local');
        $local->setOptions(array(
                'label' => 'Local',
                'object_manager'     => $entityManager,
                'target_class'       => 'Application\Entity\Local',
                'is_method' => true,
                'display_empty_item' => true,
                'find_method'        => array(
                    'name'   => 'findAll',
                )
            )
        )
            ->setAttribute('class', 'select2');
        $local->setValue(0);
        $this->add($local);

        $this->add(array(
            'name' => 'carga_horaria',
            'type' => 'Zend\Form\Element\Number',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Carga horária',
                'min'  => '0',
                'max'  => '10',
                'step' => '0.1',
            ),
            'options' => array(
                'label' => 'Carga horária',
            ),
        ));


        $this->add(array(
            'name' => 'maximo_participantes',
            'type' => 'Zend\Form\Element\Number',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Máximo de participantes',
                'min'  => '0',
                'max'  => '5000',
                'step' => '1',
            ),
            'options' => array(
                'label' => 'Máximo de participantes',
            ),
        ));

        $this->add(array(
            'name' => 'preco',
            'type' => 'Zend\Form\Element\Number',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Preço',
                'min'  => '0',
                'max'  => '10',
                'step' => '0.1',
            ),
            'options' => array(
                'label' => 'Preço',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'tipo',
            'attributes' =>  array(
                'id' => 'tipo',
                'options' => array(
                    '' => '',
                    'palestra' => 'Palestra',
                    'minicurso' => 'Minicurso',
                ),
            ),
            'options' => array(
                'label' => 'Tipo',
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
}