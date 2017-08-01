<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Hydrator;

/**
 * Monitor
 *
 * @ORM\Table(name="monitor", indexes={@ORM\Index(name="fk_monitor_participante1_idx", columns={"participante_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\MonitorRepository")
 */
class Monitor
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
     * @var \DateTime
     *
     * @ORM\Column(name="cadastrado_em", type="datetime", nullable=false)
     */
    private $cadastradoEm = 'CURRENT_TIMESTAMP';

    /**
     * @var Participante
     *
     * @ORM\ManyToOne(targetEntity="Participante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participante_id", referencedColumnName="id")
     * })
     */
    private $participante;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Evento", mappedBy="monitor")
     */
    private $evento;

    /**
     * Monitor constructor.
     * @param array $options
     */
    public function __construct(array $options = array()){
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->evento = new ArrayCollection();
    }

    public function toArray(){
        return (new Hydrator\ClassMethods)->extract($this);
    }

    public function __toString()
    {
        return $this->getParticipante()->__toString();
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

    /**
     * @return Participante
     */
    public function getParticipante()
    {
        return $this->participante;
    }

    /**
     * @param Participante $participante
     */
    public function setParticipante($participante)
    {
        $this->participante = $participante;
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



}

