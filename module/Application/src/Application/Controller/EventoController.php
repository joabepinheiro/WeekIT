<?php

namespace Application\Controller;

use Application\Auth\AdapterAdministrador;
use Application\Form\Inscrever;
use Application\Form\LoginAdministradorForm;
use Base\Controller\ActionController;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Application\Auth\Adapter;

class EventoController extends ActionController
{

    public function __construct()
    {
        $this->entity       = 'Application\Entity\Evento';
        $this->form         = 'Application\Form\Evento';
        $this->formService  = true;
        $this->service      = 'Application\Service\Evento';
        $this->controller   = 'evento';
        $this->route        = 'evento/default';
    }

    public function editarAction(){
        $form    = ($this->formService) ? $this->getServiceLocator()->get($this->form) : new $this->form();
        $form->get('submit')->setLabel('Editar');

        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->getPK());

        if(!$entity){
            return $this->redirect()->toRoute($this->route, array('action', 'listar'));
        }

        $form->setData($entity->toArray());

        if($request->isPost()) {
            $form->setData($request->getPost());

            if($form->isValid()) {

                $service = $this->getServiceLocator()->get($this->service);
                $entity = $service->update($request->getPost()->toArray());

                if($entity){
                    $this->flashMessenger()
                        ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                        ->addMessage($entity. ' atualizado com sucesso');

                    $this->redirect()->toRoute($this->route);
                }

            }
        }

        return new ViewModel(array(
            'form' => $form,
            'entity' => $entity
        ));
    }

    public function detalhesAction(){
        $entity = $this->getEm()->getRepository($this->entity)->findOneBy(['id' =>$this->params('id', 0)]);

        return new ViewModel(array(
            'entity' => $entity
        ));
    }

}

