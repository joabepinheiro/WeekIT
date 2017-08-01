<?php

namespace Application\Controller;

use Application\Auth\AdapterAdministrador;
use Application\Entity\Evento;
use Application\Form\LoginAdministradorForm;
use Application\Service\Inscricao;
use Base\Controller\ActionController;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Application\Auth\Adapter;

class InscricaoController extends ActionController
{

    public function __construct()
    {
        $this->entity       = 'Application\Entity\Inscricao';
        $this->form         = 'Application\Form\Inscricao';
        $this->formService  = false;
        $this->service      = 'Application\Service\Inscricao';
        $this->controller   = 'inscricao';
        $this->route        = 'inscricao/default';
    }


    /**
     * Cadastra o usuario logado no evento recebido parametro
     * */
    public function cadastrarAction()
    {

        $data = [
            'participante'  => $this->getEm()->getRepository('Application\Entity\Participante')->find($this->getLogado()->getId()),
            'evento'  => $this->getEm()->getRepository('Application\Entity\Evento')->find($this->params('evento', 0 ))
        ];

        $entity = (new Inscricao($this->getEm()))->insert($data);

        if($entity){
            $this->flashMessenger()
                ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                ->addMessage('Inscrição em '. $entity. ' realizada com sucesso');

        }

        return $this->redirect()->toRoute('perfil/default', array('action' => 'eventos'));
    }

    public function deletarAction(){
        $data = [
            'participante'  => $this->getEm()->getRepository('Application\Entity\Participante')->find($this->getLogado()->getId()),
            'evento'  => $this->getEm()->getRepository('Application\Entity\Evento')->find($this->params('evento', 0 ))
        ];

        $entity = $this->getEm()->getRepository($this->entity)->findOneBy($data);
        $id         = (new Inscricao($this->getEm()))->delete(array('id'=> $entity->getId()));

        if($id){
            $this->flashMessenger()
                ->setNamespace(FlashMessenger::NAMESPACE_WARNING)
                ->addMessage($entity->getEvento(). ' removido');
        }

        return $this->redirect()->toRoute('perfil/default', array('action' => 'eventos'));
    }



    public function detalhesAction(){
        $entity = $this->getEm()->getRepository($this->entity)->findOneBy(['id' =>$this->params('id', 0)]);

        return new ViewModel(array(
            'entity' => $entity
        ));
    }


    public function pagarAction(){
        $data = [
            'id'        => $this->params('id',  0 ),
            'status'    => 'pago',
        ];

        $entity = (new Inscricao($this->getEm()))->update($data);

        if($entity){
            $this->flashMessenger()
                ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                ->addMessage('Inscrição de '. $entity->getParticipante(). 'em  '. $entity->getEvento(). ' paga');

        }

        return $this->redirect()->toRoute('inscricao/default', array('action' => 'listar'));
    }


    public function cancelarAction(){
        $data = [
            'id'        => $this->params('id',  0 ),
            'status'    => 'cancelado',
        ];

        $entity = (new Inscricao($this->getEm()))->update($data);

        if($entity){
            $this->flashMessenger()
                ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                ->addMessage('Inscrição de '. $entity->getParticipante(). 'em  '. $entity->getEvento(). ' cancelada');

        }

        return $this->redirect()->toRoute('inscricao/default', array('action' => 'listar'));
    }

    public function andamentoAction(){
        $data = [
            'id'        => $this->params('id',  0 ),
            'status'    => 'andamento',
        ];

        $entity = (new Inscricao($this->getEm()))->update($data);

        if($entity){
            $this->flashMessenger()
                ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                ->addMessage('Inscrição de '. $entity->getParticipante(). 'em  '. $entity->getEvento(). ' restaurada em andamento');

        }

        return $this->redirect()->toRoute('inscricao/default', array('action' => 'listar'));
    }

}

