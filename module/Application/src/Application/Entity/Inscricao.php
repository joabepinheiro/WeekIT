<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Hydrator;


/**
 * Inscricao
 *
 * @ORM\Table(name="inscricao", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_inscricao_participante1_idx", columns={"participante_id"}), @ORM\Index(name="fk_inscricao_evento1_idx", columns={"evento_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\InscricaoRepository")
 */

class Inscricao
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
     * @ORM\Column(name="data", type="datetime", nullable=false)
     */
    private $data = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status = 'andamento';

    /**
     * @var boolean
     *
     * @ORM\Column(name="presente", type="boolean", nullable=true)
     */
    private $presente;

    /**
     * @var \Evento
     *
     * @ORM\ManyToOne(targetEntity="Evento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evento_id", referencedColumnName="id")
     * })
     */
    private $evento;

    /**
     * @var \Participante
     *
     * @ORM\ManyToOne(targetEntity="Participante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participante_id", referencedColumnName="id")
     * })
     */
    private $participante;


    /**
     * Constructor
     */
    public function __construct(array $options = array()){
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->data  = new \DateTime();
    }

    public function toArray(){
        return (new Hydrator\ClassMethods)->extract($this);
    }

    public function __toString()
    {
        return $this->getParticipante() . ' inscrito em ' . $this->getEvento()->getIdentificador();
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
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param \DateTime $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isPresente()
    {
        return $this->presente;
    }

    /**
     * @param bool $presente
     */
    public function setPresente($presente)
    {
        $this->presente = $presente;
    }

    /**
     * @return Evento
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * @param Evento $evento
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;
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




}

