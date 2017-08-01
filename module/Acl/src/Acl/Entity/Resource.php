<?php

namespace Acl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="acl_resources")
 * @ORM\Entity(repositoryClass="Acl\Entity\ResourceRepository")
 */

class Resource extends EntityAbstract
{


    protected $nomeSingular = 'Recurso';
    protected $nomePlural  = 'Recursos';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;


    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $descricao;
    
    
    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;
    
    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;
    
    
    public function __construct($options = array())
    {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");

    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
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


    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt() {
        $this->createdAt = new \Datetime("now");
        return $this;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt() {
        $this->createdAt = new \Datetime("now");
        return $this;
    }

    public function __toString() {
        return $this->nome;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods)->extract($this);
    }

    /**
     * @return mixed
     */
    public function getNomeSingular()
    {
        return $this->nomeSingular;
    }

    /**
     * @param mixed $nomeSingular
     */
    public function setNomeSingular($nomeSingular)
    {
        $this->nomeSingular = $nomeSingular;
    }

    /**
     * @return mixed
     */
    public function getNomePlural()
    {
        return $this->nomePlural;
    }

    /**
     * @param mixed $nomePlural
     */
    public function setNomePlural($nomePlural)
    {
        $this->nomePlural = $nomePlural;
    }


    
}
