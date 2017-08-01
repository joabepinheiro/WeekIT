<?php

namespace Acl\Controller;


use Base\Controller\ActionController;
use Zend\View\Model\ViewModel;

class ResourcesController extends ActionController
{

    public function __construct() {
        $this->entity = 'Acl\Entity\Resource';
        $this->service = 'Acl\Service\Resource';
        $this->form = 'Acl\Form\Resource';
        $this->controller = 'resources';
        $this->route = 'acl-resources/default';
    }

    public function indexAction(){
        $this->layout()->setVariable('titulo','Recursos');
        return parent::indexAction();
    }

    public function cadastrarAction(){
        $this->layout()->setVariable('titulo','Cadastrar Recurso');
        return parent::cadastrarAction();
    }

    public function editarAction(){
        $this->layout()->setVariable('titulo','Editar Recurso');
        return parent::editarAction();
    }

    public function deletarAction(){

       $this->setReferences([
           array(
               'entity'=>'Acl\Entity\Privilege',
               'find' => array('resource'=> $this->getPK())
           )

       ]);
        return parent::deletarAction();
    }


}
