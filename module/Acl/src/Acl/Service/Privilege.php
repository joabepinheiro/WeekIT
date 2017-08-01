<?php

namespace Acl\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class Privilege extends AbstractService
{
    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'Acl\Entity\Privilege';
    }
    
    public function insert($data)
    {

        $entity = null;

        if($data['role'] == 'todos'){
            $roles = $this->em->getRepository('Acl\Entity\Role')->findAll();

            foreach($roles as $role){
                $data['role'] = $role->getId();
                $entity = new $this->entity($data);

                $role = $this->em->getReference('Acl\Entity\Role',$data['role']);
                $entity->setRole($role); // Injetando entidade carregada

                $resource = $this->em->getReference('Acl\Entity\Resource',$data['resource']);
                $entity->setResource($resource); // Injetando entidade carregada

                $this->em->persist($entity);
                $this->em->flush();
            }
        }else{
            $entity = new $this->entity($data);

            $role = $this->em->getReference('Acl\Entity\Role',$data['role']);
            $entity->setRole($role); // Injetando entidade carregada

            $resource = $this->em->getReference('Acl\Entity\Resource',$data['resource']);
            $entity->setResource($resource); // Injetando entidade carregada

            $this->em->persist($entity);
            $this->em->flush();

        }

        return $entity;

    }
    
    public function update($data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);
        
        $role = $this->em->getReference('Acl\Entity\Role',$data['role']);
        $entity->setRole($role); // Injetando entidade carregada
        
        $resource = $this->em->getReference('Acl\Entity\Resource',$data['resource']);
        $entity->setResource($resource); // Injetando entidade carregada
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
    
}
