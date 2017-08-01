<?php

namespace Application\Form;

use Base\Form\FormAbstract;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Form\Element\ObjectSelect;
use Zend\Form\Element;

class Inscrever extends FormAbstract{

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

        $local = new ObjectSelect('evento');
        $local->setOptions(array(
                'label' => 'Evento',
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
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
        ));
    }
}