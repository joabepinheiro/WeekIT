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

class PerfilController extends ActionController
{

    public function eventosAction(){
        $form       = new Inscrever(null, $this->getEm());

        $eventos = $this->getEm()->getRepository('Application\Entity\Evento')->findAll();
        $minhas_inscricoes = $this->getEm()->getRepository('Application\Entity\Inscricao')->getMinhasInscricoes($this->getLogado()->getId());


        $request    = $this->getRequest();


        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);

                $entity = $service->insert($request->getPost()->toArray());

                if($entity){
                    $this->flashMessenger()
                        ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                        ->addMessage($entity . ' inscrito com sucesso');

                    $form       = ($this->formService) ? $this->getServiceLocator()->get($this->form) : new $this->form();
                    $this->redirect()->toRoute($this->route);
                }

            }
        }

        return new ViewModel(array(
            'form'          => $form,
            'eventos'       => $eventos,
            'minhas_inscricoes'  => $minhas_inscricoes
        ));
    }
}

