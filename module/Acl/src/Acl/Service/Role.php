<?php

namespace Acl\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class Role extends AbstractService
{

    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'Acl\Entity\Role';
    }
    
    public function insert($data)
    {
        $entity = new $this->entity($data);
        
        if($data['parent'])
        {
            $parent = $this->em->getReference($this->entity, $data['parent']);
            $entity->setParent($parent);
        }
        else 
            $entity->setParent(null);
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
    
    public function update($data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);
        
        if($data['parent'])
        {
            $parent = $this->em->getReference($this->entity, $data['parent']);
            $entity->setParent($parent);
        }
        else 
            $entity->setParent(null);
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
}
