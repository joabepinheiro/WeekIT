<?php
namespace Application\Auth;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface
{
    protected $em;
    protected $email;
    protected $senha;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function authenticate()
    {
        $repository = $this->em->getRepository('Application\Entity\Participante');
        $participante    = $repository->findByEmailSenha($this->getEmail(), $this->getSenha());

        if($participante){
            return new Result(Result::SUCCESS, $participante, array());
        }

        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array('O email ou senha estão incorretos'));
    }

    /**
     * @param EntityManager $em
     */
    public function setEm($em)
    {
        $this->em = $em;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }



}