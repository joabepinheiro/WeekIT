<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Hydrator;
use Zend\Crypt\Key\Derivation\Pbkdf2;

/**
 * Participante
 *
 * @ORM\Table(name="participante", uniqueConstraints={@ORM\UniqueConstraint(name="usuario_UNIQUE", columns={"email"}), @ORM\UniqueConstraint(name="cpf_UNIQUE", columns={"cpf"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Application\Entity\ParticipanteRepository")
 */
class Participante
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
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="sobrenome", type="string", length=100, nullable=false)
     */
    private $sobrenome;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=15, nullable=false)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="instituicao", type="string", length=255, nullable=true)
     */
    private $instituicao;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", nullable=false)
     */
    private $sexo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cadastrado_em", type="datetime", nullable=false)
     */
    private $cadastradoEm = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="telefone1", type="string", length=15, nullable=true)
     */
    private $telefone1;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone2", type="string", length=15, nullable=true)
     */
    private $telefone2;

    /**
     * @var string
     *
     * @ORM\Column(name="campus", type="string", length=150, nullable=true)
     */
    private $campus;

    /**
     * @var string
     *
     * @ORM\Column(name="curso", type="string", length=255, nullable=true)
     */
    private $curso;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=255, nullable=false)
     */
    private $senha;

    private $hash = 'jm8NY81CiHA=edhdvFRy14g54sGFG';


    /**
     * Participante constructor.
     * @param array $options
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
        return $this->getNome() . ' '. $this->getSobrenome();
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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * @param string $sobrenome
     */
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    /**
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return string
     */
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    /**
     * @param string $instituicao
     */
    public function setInstituicao($instituicao)
    {
        $this->instituicao = $instituicao;
    }

    /**
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param string $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
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
     * @return string
     */
    public function getTelefone1()
    {
        return $this->telefone1;
    }

    /**
     * @param string $telefone1
     */
    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;
    }

    /**
     * @return string
     */
    public function getTelefone2()
    {
        return $this->telefone2;
    }

    /**
     * @param string $telefone2
     */
    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;
    }

    /**
     * @return string
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param string $campus
     */
    public function setCampus($campus)
    {
        $this->campus = $campus;
    }

    /**
     * @return string
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * @param string $curso
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;
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
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $this->encryptPassword($senha);
    }

    public function encryptPassword($password){
        return base64_encode(Pbkdf2::calc('sha256', $password, $this->hash, 10000, strlen($password*2)));
    }


}

