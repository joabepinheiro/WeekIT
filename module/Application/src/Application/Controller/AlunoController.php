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

class AlunoController extends ActionController
{
    public function perfilAction()
    {
        $aluno = $this->getLogado();

        return new ViewModel(array(
            'aluno' => $aluno
        ));
    }
}

