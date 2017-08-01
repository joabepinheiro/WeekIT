<?php
namespace Application\Form;


use Application\Entity\ColaboreRepository;
use Application\Form\Filter\LoginFilter;
use Base\Form\FormAbstract;
use Doctrine\ORM\EntityManager;
use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceManager;


class LoginForm extends FormAbstract
{
    public function __construct($em)
    {
        parent::__construct('');

        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');

        $this->setInputFilter((new LoginFilter())->getInputFilter());

        $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Informe seu email'
            ),
            'options' => array(
                'label' => 'Informe seu email',
            ),
        ));

        $this->add(array(
            'name' => 'senha',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' =>  'Informe sua senha'
            ),
            'options' => array(
                'label' => 'Informe sua senha',
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }
}