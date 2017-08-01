<?php

namespace Application\Entity;

use Doctrine\ORM\EntityRepository;


class ParticipanteRepository extends EntityRepository
{
    public function findByEmailSenha($email, $senha){

        return $this->_em->getRepository($this->_entityName)->findOneBy(array(
            'email' => $email,
            'senha' => (new Participante())->encryptPassword($senha)
        ));
    }
}
