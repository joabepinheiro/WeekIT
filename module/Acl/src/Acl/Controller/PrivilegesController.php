<?php

namespace Acl\Controller;

use Base\Controller\ActionController;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\View\Model\ViewModel;

class PrivilegesController extends ActionController
{

    public function __construct() {
        $this->entity       = 'Acl\Entity\Privilege';
        $this->service      = 'Acl\Service\Privilege';
        $this->form         = 'Acl\Form\Privilege';
        $this->controller   = "privileges";
        $this->route        = "acl-privileges/default";
    }

    public function indexAction(){
        $this->layout()->setVariable('titulo','Privilégios');
        return parent::indexAction();
    }
    
    public function cadastrarAction()
    {
        $this->layout()->setVariable('titulo','Cadastrar privilégio');

        $form = $this->getServiceLocator()->get('Acl\Form\Privilege');
        $form->get('submit')->setLabel('Cadastrar');
        $request = $this->getRequest();

        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $entity = $service->insert($request->getPost()->toArray());

                $this->flashMessenger()
                    ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                    ->addMessage($entity .' cadastrado com sucesso');

                return $this->redirect()->toRoute($this->route);
            }
        }

        return new ViewModel(array('form'=>$form));
    }

    public function editarAction()
    {
        $this->layout()->setVariable('titulo','Editar privilégio');

        $form = $this->getServiceLocator()->get('Acl\Form\Privilege');
        $form->get('submit')->setLabel('Editar');
        $request = $this->getRequest();
        
        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id',0));
        
        if($this->params()->fromRoute('id',0))
            $form->setData($entity->toArray());
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $entity = $service->update($request->getPost()->toArray());

                $this->flashMessenger()
                    ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                    ->addMessage($entity .' atualizado com sucesso');
                
                return $this->redirect()->toRoute($this->route);
            }
        }
        
        return new ViewModel(array('form'=>$form));
    }

}
