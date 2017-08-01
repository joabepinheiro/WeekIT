<?php
namespace Base\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Application;
use Zend\Session\Container;
use Zend\Hydrator;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

abstract class AbstractService {

    protected $em;
    protected $entity;
    protected $errorCodeValidator = array();

    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    public function insert($data)
    {

        $entity = (is_array($data)) ? new $this->entity($data) : $data;

        try {
            $this->em->persist($entity);
            $this->em->flush();
        } catch (\Exception  $exception) {
            return $this->exceptionMenssage($exception);
        }

        return $entity;
    }


    public function update($data){

        $entity = null;

        if(is_object($data)){
            $entity = $data;
        }elseif (is_array($data)){
            $entity = $this->em->getRepository($this->entity)->findOneBy(array('id' => $data['id']));
            (new Hydrator\ClassMethods())->hydrate($data, $entity);
        }

        $this->em->merge($entity);

        try {
            $this->em->flush();
        } catch (\Exception  $exception) {

           return $this->exceptionMenssage($exception);
        }

        return $entity;
    }

    public function delete($id){

        $entity = $this->em->getRepository($this->entity)->findOneBy($id);

        if($entity){
            $this->em->remove($entity);
            try {
                $this->em->flush();
            } catch (\Exception  $exception) {
                return $this->exceptionMenssage($exception);
            }
            return $id;
        }
        return null;
    }


    public function getUsuarioLogado(){
        $container = new Container('logado');
        return  $container->offsetGet('usuario');
    }


    public function exceptionMenssage($exception){
        $mensagem = null;

        switch ($exception->getErrorCode()){
            case 1062:
                $mensagem = (isset($this->errorCodeValidator[1062])) ? ($this->errorCodeValidator[1062]) : $exception->getMessage();
                break;
            case 1451:
                $mensagem = (isset($this->errorCodeValidator[1451])) ? ($this->errorCodeValidator[1451]) : $exception->getMessage();
                break;
            case 1644:
                $mensagem = explode(': 1644 ',$exception->getMessage())[1];
                break;
            default:
                $mensagem = $exception->getMessage();
                break;
        }

        (new FlashMessenger())->setNamespace(FlashMessenger::NAMESPACE_ERROR)
            ->addMessage($mensagem);

        return null;
    }

}