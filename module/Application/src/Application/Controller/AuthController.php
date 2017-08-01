<?php

namespace Application\Controller;

use Application\Auth\AdapterAdministrador;
use Application\Form\EsqueciSenhaForm;
use Application\Form\LoginAdministradorForm;
use Application\Form\LoginForm;
use Application\Service\Suporte;
use Base\Controller\ActionController;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Application\Auth\Adapter;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Session\Container;

class AuthController extends ActionController
{


    public function indexAction(){

        if($this->isLogado()){
            $this->redirectHome();
        }

        $form = new LoginForm($this->getEm());
        $request = $this->getRequest();
        $menssages = array();

        $view = new ViewModel();
        $view->setTerminal(true);

        if($request->isPost()){
            $form->setData($request->getPost());

            if($form->isValid()){
                $data = $form->getData();

                $auth = new AuthenticationService();
                $sessioStorage = new SessionStorage('login');
                $auth->setStorage($sessioStorage);

                $authAdapter = new Adapter($this->em);
                $authAdapter->setEmail($data['email']);
                $authAdapter->setSenha($data['senha']);
                $result = $auth->authenticate($authAdapter);

                if($result->isValid()){
                    //Armazena o usuário em uma sessão
                    /** @var  $usuarioLogado \Application\Entity\Usuario */
                    $usuarioLogado = $auth->getIdentity();
                    $sessioStorage->write($usuarioLogado, null);
                    $container = new Container('logado');

                    $container->offsetSet('usuario', $usuarioLogado->toArray());

                    $this->redirectHome();
                }
                $menssages =  current($result->getMessages());
            }else{
                $menssages = current(current($form->getMessages()));
            }
        }
        $view->setVariable('form', $form);
        $view->setVariable('menssages',  $menssages);

        return $view;
    }

    /**
     * Action de logout de todos os ususario de sistema
     * @return \Zend\Http\Response
     */
    function logoutAction(){

        $auth = new AuthenticationService();
        $auth->setStorage(new SessionStorage('login'));
        $auth->clearIdentity();

        $container = new Container('logado');
        $tipo = $container->offsetGet('usuario')['tipo'];
        $container->getManager()->destroy();


        if($tipo == 'administrador'){
            return $this->redirect()->toRoute('login_administrador');
        }
        return $this->redirect()->toRoute('login');
    }

    public function esqueciSenhaAction(){

        $form =  new EsqueciSenhaForm();

        $request = $this->getRequest();
        $menssages = array();

        $view = new ViewModel();
        $view->setTerminal(true);
        $view->setVariable('form', $form);
        $view->setVariable('menssages',  $menssages);


        if($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();

                $service  = new Suporte($this->getEm());
                $result = $service->enviarSuporte($data, $email, $nome);
            }
        }


        return $view;
    }

    public function negadoAction(){

        $view = new ViewModel();
        $view->setTerminal(true);
        return $view;
    }


}

