<?php

namespace Acl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="acl_roles")
 * @ORM\Entity(repositoryClass="Acl\Entity\RoleRepository")
 */

class Role
{
    protected $nomeSingular = 'Papel';
    protected $nomePlural = 'Papéis';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Acl\Entity\Role")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;
    
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

    public function getParent() {
        return $this->parent;
    }

    public function setParent($parent) {
        $this->parent = $parent;
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
        if(isset($this->parent))
            $parent = $this->parent->getId();
        else 
            $parent = false;
        
        return array(
          'id' => $this->id,
          'nome' => $this->nome,
            'parent' => $parent
        );
    }

    /**
     * @return string
     */
    public function getNomeSingular()
    {
        return $this->nomeSingular;
    }

    /**
     * @param string $nomeSingular
     */
    public function setNomeSingular($nomeSingular)
    {
        $this->nomeSingular = $nomeSingular;
    }

    /**
     * @return string
     */
    public function getNomePlural()
    {
        return $this->nomePlural;
    }

    /**
     * @param string $nomePlural
     */
    public function setNomePlural($nomePlural)
    {
        $this->nomePlural = $nomePlural;
    }


}
