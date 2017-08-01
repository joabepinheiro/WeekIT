<?php

namespace Acl\Entity;

use Doctrine\ORM\EntityRepository;

class RoleRepository extends EntityRepository {

    public function fetchParent()
    {
        $entities = $this->findAll();
        $array = array();
        
        foreach($entities as $entity)
        {
            $array[$entity->getId()]=$entity->getNome();
        }
        
        return $array;
    }

    /**
     * @return array Acl\Entity\Role
     */
    public function getRoles(){
        $querybuilder = $this->createQueryBuilder('c');

        return $querybuilder->select('c')
            ->groupBy('c.nome')
            ->orderBy('c.id', 'ASC')
            ->getQuery()->getResult();
    }
    
}
