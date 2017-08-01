<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Participante extends \Application\Entity\Participante implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'id', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'nome', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'sobrenome', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'cpf', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'instituicao', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'sexo', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'cadastradoEm', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'telefone1', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'telefone2', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'campus', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'curso', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'tipo', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'email', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'senha', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'hash'];
        }

        return ['__isInitialized__', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'id', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'nome', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'sobrenome', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'cpf', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'instituicao', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'sexo', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'cadastradoEm', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'telefone1', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'telefone2', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'campus', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'curso', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'tipo', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'email', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'senha', '' . "\0" . 'Application\\Entity\\Participante' . "\0" . 'hash'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Participante $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function toArray()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toArray', []);

        return parent::toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', []);

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getNome()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNome', []);

        return parent::getNome();
    }

    /**
     * {@inheritDoc}
     */
    public function setNome($nome)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNome', [$nome]);

        return parent::setNome($nome);
    }

    /**
     * {@inheritDoc}
     */
    public function getSobrenome()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSobrenome', []);

        return parent::getSobrenome();
    }

    /**
     * {@inheritDoc}
     */
    public function setSobrenome($sobrenome)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSobrenome', [$sobrenome]);

        return parent::setSobrenome($sobrenome);
    }

    /**
     * {@inheritDoc}
     */
    public function getCpf()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCpf', []);

        return parent::getCpf();
    }

    /**
     * {@inheritDoc}
     */
    public function setCpf($cpf)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCpf', [$cpf]);

        return parent::setCpf($cpf);
    }

    /**
     * {@inheritDoc}
     */
    public function getInstituicao()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInstituicao', []);

        return parent::getInstituicao();
    }

    /**
     * {@inheritDoc}
     */
    public function setInstituicao($instituicao)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInstituicao', [$instituicao]);

        return parent::setInstituicao($instituicao);
    }

    /**
     * {@inheritDoc}
     */
    public function getSexo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSexo', []);

        return parent::getSexo();
    }

    /**
     * {@inheritDoc}
     */
    public function setSexo($sexo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSexo', [$sexo]);

        return parent::setSexo($sexo);
    }

    /**
     * {@inheritDoc}
     */
    public function getCadastradoEm()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCadastradoEm', []);

        return parent::getCadastradoEm();
    }

    /**
     * {@inheritDoc}
     */
    public function setCadastradoEm($cadastradoEm)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCadastradoEm', [$cadastradoEm]);

        return parent::setCadastradoEm($cadastradoEm);
    }

    /**
     * {@inheritDoc}
     */
    public function getTelefone1()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTelefone1', []);

        return parent::getTelefone1();
    }

    /**
     * {@inheritDoc}
     */
    public function setTelefone1($telefone1)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTelefone1', [$telefone1]);

        return parent::setTelefone1($telefone1);
    }

    /**
     * {@inheritDoc}
     */
    public function getTelefone2()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTelefone2', []);

        return parent::getTelefone2();
    }

    /**
     * {@inheritDoc}
     */
    public function setTelefone2($telefone2)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTelefone2', [$telefone2]);

        return parent::setTelefone2($telefone2);
    }

    /**
     * {@inheritDoc}
     */
    public function getCampus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCampus', []);

        return parent::getCampus();
    }

    /**
     * {@inheritDoc}
     */
    public function setCampus($campus)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCampus', [$campus]);

        return parent::setCampus($campus);
    }

    /**
     * {@inheritDoc}
     */
    public function getCurso()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCurso', []);

        return parent::getCurso();
    }

    /**
     * {@inheritDoc}
     */
    public function setCurso($curso)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCurso', [$curso]);

        return parent::setCurso($curso);
    }

    /**
     * {@inheritDoc}
     */
    public function getTipo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTipo', []);

        return parent::getTipo();
    }

    /**
     * {@inheritDoc}
     */
    public function setTipo($tipo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTipo', [$tipo]);

        return parent::setTipo($tipo);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getSenha()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSenha', []);

        return parent::getSenha();
    }

    /**
     * {@inheritDoc}
     */
    public function setSenha($senha)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSenha', [$senha]);

        return parent::setSenha($senha);
    }

    /**
     * {@inheritDoc}
     */
    public function encryptPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'encryptPassword', [$password]);

        return parent::encryptPassword($password);
    }

}