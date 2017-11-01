<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actor
 *
 * @ORM\Table(name="actor")
 * @ORM\Entity
 */
class Actor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, unique=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="ano_nacimiento", type="integer", nullable=false, unique=false)
     */
    private $ano_nacimiento;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Actor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set anoNacimiento
     *
     * @param integer $anoNacimiento
     *
     * @return Actor
     */
    public function setAnoNacimiento($anoNacimiento)
    {
        $this->ano_nacimiento = $anoNacimiento;

        return $this;
    }

    /**
     * Get anoNacimiento
     *
     * @return integer
     */
    public function getAnoNacimiento()
    {
        return $this->ano_nacimiento;
    }
}

