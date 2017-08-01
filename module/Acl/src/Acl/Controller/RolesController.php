<?php

namespace Acl\Controller;

use Base\Controller\ActionController;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\View\Model\ViewModel;

class RolesController extends ActionController
{

    public function __construct() {
        $this->entity     = 'Acl\Entity\Role';
        $this->service    = 'Acl\Service\Role';
        $this->form       = 'Acl\Form\Role';
        $this->controller = 'roles';
        $this->route      = "acl-roles/default";
    }

    public function indexAction(){
        $this->layout()->setVariable('titulo','Papéis');
        return parent::indexAction();
    }

    public function cadastrarAction()
    {
        $this->layout()->setVariable('titulo','Cadastrar Papel');

        $form = $this->getServiceLocator()->get('Acl\Form\Role');
        $form->get('submit')->setLabel('Cadastrar');
        $request = $this->getRequest();

        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = new \Acl\Service\Role($this->getEm());
                $entity = $service->insert($request->getPost()->toArray());

                $this->flashMessenger()
                    ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                    ->addMessage($entity.' cadastrado com sucesso');

                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }

        return new ViewModel(array('form'=>$form));
    }

    public function editarAction()
    {
        $this->layout()->setVariable('titulo','Editar Papel');

        $form = $this->getServiceLocator()->get('Acl\Form\Role');
        $form->get('submit')->setLabel('Edtar');
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
                $service = new \Acl\Service\Role($this->getEm());
                $entity = $service->update($request->getPost()->toArray());

                $this->flashMessenger()
                    ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                    ->addMessage($entity .' atualizado com sucesso');
                
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }
        
        return new ViewModel(array('form'=>$form));
    }

    public function deletarAction(){

        $this->setReferences([
            array(
                'entity'=>'Acl\Entity\Privilege',
                'find' => array('role'=> $this->getPK())
            )
        ]);
        return parent::deletarAction();
    }

    public function testeAction()
    {
        /** @var $acl \Acl\Permissions\Acl */
        $acl = $this->getServiceLocator()->get('Acl\Permissions\Acl');
        
       // echo $acl->isAllowed("AI","INSTITUIÇÃOCONTROLER","Deletar")? "Permitido" : "Negado";

    }
}
