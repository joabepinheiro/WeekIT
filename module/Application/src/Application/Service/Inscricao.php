<?php
namespace Application\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Filter\Exception\InvalidArgumentException;
use Zend\Stdlib\Hydrator;


class Inscricao extends AbstractService{

    public function __construct(EntityManager $em){
        parent::__construct($em);

        $this->entity = 'Application\Entity\Inscricao';
    }
}

