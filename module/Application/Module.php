<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Service\Evento;
use Application\Service\Inscricao;
use Application\Service\Local;
use Application\Service\Monitor;
use Application\Service\Palestrante;
use Application\Service\Participante;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\Validator\AbstractValidator;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $services = $e->getApplication()->getServiceManager();
        $config = $services->get('config');
        $phpSettings = $config['php_settings'];
        if ($phpSettings) {
            foreach ($phpSettings as $key => $value) {
                ini_set($key, $value);
            }
        }

        //Anexa o evento validaAuth no dispath
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array(
            $this,
            'validaAuth'
        ), 101);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig(){
        return array(
            'factories' => array(
                'Application\Service\Evento' => function($sm){
                    return new Evento($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Application\Service\Inscricao' => function($sm){
                    return new Inscricao($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Application\Service\Local' => function($sm){
                    return new Local($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Application\Service\Monitor' => function($sm){
                    return new Monitor($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Application\Service\Palestrante' => function($sm){
                    return new Palestrante($sm->get('Doctrine\ORM\EntityManager'));
                },

                'Application\Service\Participante' => function($sm){
                    return new Participante($sm->get('Doctrine\ORM\EntityManager'));
                },

                'Application\Form\Evento' => function($sm){
                    return new \Application\Form\Evento(null, $sm->get('Doctrine\ORM\EntityManager'));
                },

            )
        );
    }

    public function getViewHelperConfig(){
        return array(
            'factories' => array(
            )
        );
    }

    /**
     * @param $e
     * @return null
     */
    public function validaAuth($e){
        $matches    = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
        $action     = $matches->getParam('action');

        $container = new Container('logado');

        if(
            $controller == 'Application\Controller\Publico' ||
            $controller == 'Application\Controller\Auth'||
            $controller == 'Application\Controller\Index'
        ){
            return true;
        }


        if($container->offsetExists('usuario')){
            $tipoDeUsuario  = $container->offsetGet('usuario')['tipo'];

            $acl =  $e->getApplication()->getServiceManager()->get('Acl\Permissions\Acl');
            $result = $acl->isAllowed($tipoDeUsuario, $controller,$action)? true : false;


            if(!$result &&
                $controller != 'Application\Controller\Auth' &&
                $controller != 'Application\Controller\Index'
            ){

                return $this->toRoute($e, 'negado');
            }
        }else{
            return $this->toRoute($e, 'login');
        }
    }

    public function toRoute(MvcEvent $e, $route, $action = null){

        $url = $e->getRouter()->assemble(array('action' => $action), array('name' => $route));
        $response = $e->getResponse();
        $response->getHeaders()->addHeaderLine('Location', $url);
        $response->setStatusCode(302);
        $response->sendHeaders();
        return null;
    }
}
