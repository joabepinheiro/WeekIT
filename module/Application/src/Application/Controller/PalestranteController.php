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

class PalestranteController extends ActionController
{

    public function __construct()
    {
        $this->entity       = 'Application\Entity\Palestrante';
        $this->form         = 'Application\Form\Palestrante';
        $this->formService  = false;
        $this->service      = 'Application\Service\Palestrante';
        $this->controller   = 'palestrante';
        $this->route        = 'palestrante/default';
    }

    public function detalhesAction(){
        $entity = $this->getEm()->getRepository($this->entity)->findOneBy(['id' =>$this->params('id', 0)]);

        return new ViewModel(array(
            'entity' => $entity
        ));
    }

}

