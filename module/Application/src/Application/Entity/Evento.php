<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\This;
use Zend\Hydrator;

/**
 * Evento
 *
 * @ORM\Table(name="evento", uniqueConstraints={@ORM\UniqueConstraint(name="identificador_UNIQUE", columns={"identificador"})}, indexes={@ORM\Index(name="fk_evento_local_idx", columns={"local_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\EventoRepository")
 */
class Evento
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
     * @ORM\Column(name="identificador", type="string", length=5, nullable=false)
     */
    private $identificador;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    private $titulo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="datetime", nullable=false)
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fim", type="datetime", nullable=false)
     */
    private $fim;

    /**
     * @var float
     *
     * @ORM\Column(name="carga_horaria", type="float", precision=10, scale=0, nullable=false)
     */
    private $cargaHoraria;

    /**
     * @var integer
     *
     * @ORM\Column(name="maximo_participantes", type="integer", nullable=false)
     */
    private $maximoParticipantes;

    /**
     * @var float
     *
     * @ORM\Column(name="preco", type="float", precision=10, scale=0, nullable=false)
     */
    private $preco = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", nullable=false)
     */
    private $tipo;

    /**
     * @var \Local
     *
     * @ORM\ManyToOne(targetEntity="Local")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="local_id", referencedColumnName="id")
     * })
     */
    private $local;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Monitor", inversedBy="evento")
     * @ORM\JoinTable(name="evento_has_monitor",
     *   joinColumns={
     *     @ORM\JoinColumn(name="evento_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="monitor_id", referencedColumnName="id")
     *   }
     * )
     */
    private $monitor;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Palestrante", inversedBy="evento", cascade={"all"})
     * @ORM\JoinTable(name="evento_has_palestrante",
     *   joinColumns={
     *     @ORM\JoinColumn(name="evento_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="palestrante_id", referencedColumnName="id")
     *   }
     * )
     */
    private $palestrante;

    /**
     * Collection com todos os inscritos do evento
     * @ORM\OneToMany(targetEntity="Application\Entity\Inscricao", mappedBy="evento")
     */
    private $inscritos;

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
        $this->monitor      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->palestrante  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->inscritos    = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cadastradoEm  = new \DateTime();
    }

    public function toArray(){
        $array =  (new Hydrator\ClassMethods)->extract($this);
        $array['local']         = $array['local']->getId();
        $array['monitor']       = $array['monitor']->toArray();
        $array['palestrante']   = $array['palestrante']->toArray();
        $array['inicio']        = $array['inicio']->format('d/m/Y h:i');
        $array['fim']           = $array['fim']->format('d/m/Y h:i');

        return $array;
    }

    public function __toString()
    {
        return $this->getTitulo();
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
    public function getIdentificador()
    {
        return $this->identificador;
    }

    /**
     * @param string $identificador
     */
    public function setIdentificador($identificador)
    {
        $this->identificador = $identificador;
    }

    /**
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return \DateTime
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * @param \DateTime $inicio
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    }

    /**
     * @return \DateTime
     */
    public function getFim()
    {
        return $this->fim;
    }

    /**
     * @param \DateTime $fim
     */
    public function setFim($fim)
    {
        $this->fim = $fim;
    }

    /**
     * @return float
     */
    public function getCargaHoraria()
    {
        return $this->cargaHoraria;
    }

    /**
     * @param float $cargaHoraria
     */
    public function setCargaHoraria($cargaHoraria)
    {
        $this->cargaHoraria = $cargaHoraria;
    }

    /**
     * @return int
     */
    public function getMaximoParticipantes()
    {
        return $this->maximoParticipantes;
    }

    /**
     * @param int $maximoParticipantes
     */
    public function setMaximoParticipantes($maximoParticipantes)
    {
        $this->maximoParticipantes = $maximoParticipantes;
    }

    /**
     * @return float
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @param float $preco
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return Local
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * @param Local $local
     */
    public function setLocal($local)
    {
        $this->local = $local;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMonitor()
    {
        return $this->monitor;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $monitor
     */
    public function setMonitor($monitor)
    {
        $this->monitor = $monitor;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPalestrante()
    {
        return $this->palestrante;
    }

    /**
     * @param \Doctrine\Common\Collections\$ $palestrante
     */
    public function setPalestrante($palestrante)
    {
        $this->palestrante = new \Doctrine\Common\Collections\ArrayCollection($palestrante);;
    }

    public function addPalestrante($palestrante){
        $this->palestrante->add($palestrante);
    }

    /**
     * @return mixed
     */
    public function getInscritos()
    {
        return $this->inscritos;
    }

    /**
     * @param mixed $inscritos
     */
    public function setInscritos($inscritos)
    {
        $this->inscritos = $inscritos;
    }

    public function addInscritos($inscrito){
        return $this->inscritos->add($inscrito);

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
