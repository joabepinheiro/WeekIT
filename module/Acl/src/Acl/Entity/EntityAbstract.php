<?php

namespace Acl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

class EntityAbstract
{

    protected $nomeSingular;
    protected $nomePlural;

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
