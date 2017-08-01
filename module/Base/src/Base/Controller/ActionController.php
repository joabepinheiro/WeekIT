<?php
namespace Base\Controller;
use Application\Entity\Participante;
use Application\Entity\Usuario;
use Application\Form\Search;
use Base\Form\DeletarForm;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Zend\Form\Form;
use Zend\Http\Request;
use Zend\Mvc\Application;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\Session\Container;
use zend\View\Model\ViewModel;

use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

/** @var  $em \Doctrine\ORM\EntityManager */

class ActionController extends AbstractActionController {
    protected $em;
    protected $service;
    protected $entity;
    protected $form;
    protected $formService = false;
    protected $route;
    protected $route_params = array(
        'deletar' => array()
    );
    protected $controller;
    protected $action;

    public function  indexAction(){
        return $this->redirect()->toRoute($this->route, array('action' => 'listar'));
    }

    public function cadastrarAction(){

        $form       = ($this->formService) ? $this->getServiceLocator()->get($this->form) : new $this->form();
        //$form->get('submit')->setLabel('Cadastrar');

        $request    = $this->getRequest();

        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);

                $entity = $service->insert($request->getPost()->toArray());

                if($entity){
                    $this->flashMessenger()
                        ->setNamespace(FlashMessenger::NAMESPACE_SUCCESS)
                        ->addMessage($entity . ' cadastrado com sucesso');

                    $form       = ($this->formService) ? $this->getServiceLocator()->get($this->form) : new $this->form();
                    $this->redirect()->toRoute($this->route);
                }

            }
        }

        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function editarAction(){
        $form    = ($this->formService) ? $this->getServiceLocator()->get($this->form) : new $this->form();

        $form->editingMode();
        $form->get('submit')->setLabel('Editar');

        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->getPK());

        if(!$entity){
            return $this->redirect()->toRoute($this->route, array('action', 'listar'));
        }

        if($this->params()->fromRoute('id',0))
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

    /**
     * Retorna os registros da entidade com paginação
     * @return ViewModel
     */
    public function  listarAction(){

        $list = $this->getEm()->getRepository($this->entity)->findAll();
        $page = $this->params()->fromRoute('page');

        /**
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
            ->setDefaultItemCountPerPage(1);
         **/

        return new ViewModel(array(
            'data'          => $list,
            'page'          => $page,
        ));
    }

    /**
     * Retorna todos os registros da entidade sem paginação
     * @return ViewModel
     */
    public function  listarTodosAction(){

        $list = $this->getEm()->getRepository($this->entity)->findAll();

        return new ViewModel(array(
            'data' => $list,
        ));
    }

    public function deletarAction(){
        $id         = $this->params('id', 0);
        $service    = $this->getServiceLocator()->get($this->service);
        $row        = $this->getEm()->getRepository($this->entity)->findOneBy(array('id'=> $id));
        $id         = $service->delete(array('id'=> $id));

        if($id){
            $this->flashMessenger()
                ->setNamespace(FlashMessenger::NAMESPACE_ERROR)
                ->addMessage($row. ' removido');
        }

        return $this->redirect()->toRoute($this->route, $this->route_params['deletar']);
    }


    /**
     * Retorna o em do banco de dados root do sistema
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEm(){
        return $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }


    /**
     * Retorna a chave primaria enviada pela requisição,
     * @param string $pk
     * @return mixed $id
     */
    protected function getPK($pk = 'id'){
        if(!is_null($this->getRequest()->getPost()[$pk]))
            return  $this->getRequest()->getPost()[$pk];
        return $this->params()->fromRoute($pk, 0);

    }

    /**
     * Retorna o tipo do usuario logado
     * @return null
     */
    public function getTipoUsuarioLogado(){
        $container = new Container('logado');

        if($container->offsetExists('usuario')){
            return $container->offsetGet('usuario')['tipo'];
        }
        return null;
    }

    /**
     * Retorna uma inscantica de ususario logado no momento
     * @return Participante
     */
    public function getLogado(){
        $container = new Container('logado');
        $array = $container->offsetGet('usuario');

        return new Participante($array);
    }

    /**
     * A home do usuário muda a depender do tipo de usuário logado a
     * função abaixo redireciona para o home do usuario logado
     *
     * @return \Zend\Http\Response
     */
    public function redirectHome(){
        $container = new Container('logado');
        //Se existir alguem logado
        if($container->offsetExists('usuario')){

            $tipo = $container->offsetGet('usuario')['tipo'];

            if($tipo == 'aluno')
                return $this->redirect()->toRoute('aluno/default', array('action'=> 'perfil'));

            if($tipo == 'coordenador')
                return $this->redirect()->toRoute('coordenador/default', array('action'=> 'dashboard'));

            return $this->redirect()->toRoute('home');
        }else{
            $this->redirect()->toRoute('login');
        }
    }


    public function atualizarLogado(){
        $container = new Container('logado');
        $usuario  = $this->getEm()->find('Application\Entity\Usuario', $this->getLogado()->getId());
        $container->offsetSet('usuario', $usuario->toArray());
    }

    public function isLogado(){

        $container = new Container('logado');
        //Se existir alguem logado
        if($container->offsetExists('usuario')){
            return true;
        }
        return false;
    }
}