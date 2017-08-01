<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Hydrator;

/**
 * Palestrante
 *
 * @ORM\Table(name="palestrante", uniqueConstraints={@ORM\UniqueConstraint(name="descricao_UNIQUE", columns={"descricao"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\PalestranteRepository")
 */
class Palestrante
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Evento", mappedBy="palestrante", cascade={"all"})
     */
    private $evento;

    /**
     * Palestrante constructor.
     * @param array $options
     */
    public function __construct($options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->evento = new ArrayCollection();
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $evento
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;
    }

    public function addEvento($evento){
        $this->evento->add($evento);
    }

    public function removeEvento($evento){
        $this->evento->removeElement($evento);
    }



}

