<?php

namespace Application\Entity;

use Doctrine\ORM\EntityRepository;


class InscricaoRepository extends EntityRepository
{
    public function getMinhasInscricoes($participante_id){
        return $this->_em->getRepository($this->_entityName)->findBy(array(
            'participante' => new Participante(['id' => $participante_id])
        ));
    }
}
