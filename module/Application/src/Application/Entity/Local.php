<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Hydrator;

/**
 * Local
 *
 * @ORM\Table(name="local")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\LocalRepository")
 */
class Local
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    private $descricao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cadastrado_em", type="datetime", nullable=false)
     */
    private $cadastradoEm = 'CURRENT_TIMESTAMP';


    /**
     * Constructor
     */
    public function __construct(array $options = array()){
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->cadastradoEm  = new \DateTime();
    }

    public function toArray(){
        return (new Hydrator\ClassMethods)->extract($this);
    }

    public function __toString()
    {
        return $this->getDescricao();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return \DateTime
     */
    public function getCadastradoEm()
    {
        return $this->cadastradoEm;
    }

    /**
     * @param \DateTime $cadastradoEm
     */
    public function setCadastradoEm($cadastradoEm)
    {
        $this->cadastradoEm = $cadastradoEm;
    }



}

