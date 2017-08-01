<?php
namespace Application\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Filter\Exception\InvalidArgumentException;
use Zend\Stdlib\Hydrator;


class Local extends AbstractService{

    public function __construct(EntityManager $em){
        parent::__construct($em);

        $this->entity = 'Application\Entity\Local';
        $this->errorCodeValidator = [
            1062 => 'Já existe um local cadastrado com esse nome',
            1451 => 'Para excluir esse local você deverá excluir todos os eventos a ele vinculados'
        ];
    }

}

