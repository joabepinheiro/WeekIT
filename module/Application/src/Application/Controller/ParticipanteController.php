<?php

namespace Application\Controller;

use Application\Auth\AdapterAdministrador;
use Application\Form\LoginAdministradorForm;
use Base\Controller\ActionController;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Application\Auth\Adapter;

class ParticipanteController extends ActionController
{

    public function __construct()
    {
        $this->entity       = 'Application\Entity\Participante';
        $this->form         = 'Application\Form\Participante';
        $this->formService  = false;
        $this->service      = 'Application\Service\Participante';
        $this->controller   = 'participante';
        $this->route        = 'participante/default';
    }

    public function cadastrarAction()
    {
        $form       = ($this->formService) ? $this->getServiceLocator()->get($this->form) : new $this->form();
        $form->get('submit')->setLabel('Cadastrar');

        $request    = $this->getRequest();

        if($request->isPost())
        {
            $data = $request->getPost()->toArray();
            $data['tipo'] = 'aluno';
            $form->setData($data);

            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);

                $entity = $service->insert($data);

                if($entity){
                    $this->flashMessenger()
                        ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                        ->addMessage($entity . ' cadastrado com sucesso');

                    $form       = ($this->formService) ? $this->getServiceLocator()->get($this->form) : new $this->form();
                }

            }
        }

        $view_model= new ViewModel(array(
            'form' => $form
        ));

        $view_model->setTerminal(true);

        return $view_model;
    }


    public function detalhesAction(){
        $entity = $this->getEm()->getRepository($this->entity)->findOneBy(['id' =>$this->params('id', 0)]);

        return new ViewModel(array(
            'entity' => $entity
        ));
    }

}

