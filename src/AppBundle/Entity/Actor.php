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
     * @ORM\Column(name="nombre", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="ano_nacimiento", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $ano_nacimiento;

    /**
     * @var \AppBundle\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pais", inversedBy="actores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     * })
     */
    private $pais;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", inversedBy="actores")
     * @ORM\JoinTable(name="actor_pelicula",
     *   joinColumns={
     *     @ORM\JoinColumn(name="actor_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pelicula_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $peliculas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->peliculas = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * Set pais
     *
     * @param \AppBundle\Entity\Pais $pais
     *
     * @return Actor
     */
    public function setPais(\AppBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \AppBundle\Entity\Pais
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Add pelicula
     *
     * @param \AppBundle\Entity\Pelicula $pelicula
     *
     * @return Actor
     */
    public function addPelicula(\AppBundle\Entity\Pelicula $pelicula)
    {
        $this->peliculas[] = $pelicula;

        return $this;
    }

    /**
     * Remove pelicula
     *
     * @param \AppBundle\Entity\Pelicula $pelicula
     */
    public function removePelicula(\AppBundle\Entity\Pelicula $pelicula)
    {
        $this->peliculas->removeElement($pelicula);
    }

    /**
     * Get peliculas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeliculas()
    {
        return $this->peliculas;
    }
}

