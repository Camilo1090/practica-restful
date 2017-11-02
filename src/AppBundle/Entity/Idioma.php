<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Idioma
 *
 * @ORM\Table(name="idioma")
 * @ORM\Entity
 */
class Idioma
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", mappedBy="audios")
     */
    private $idiomas_audios;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", inversedBy="subtitulos")
     * @ORM\JoinTable(name="idioma_pelicula",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idioma_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pelicula_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $idiomas_subtitulos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idiomas_audios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idiomas_subtitulos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Idioma
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
     * Add idiomasAudio
     *
     * @param \AppBundle\Entity\Pelicula $idiomasAudio
     *
     * @return Idioma
     */
    public function addIdiomasAudio(\AppBundle\Entity\Pelicula $idiomasAudio)
    {
        $this->idiomas_audios[] = $idiomasAudio;

        return $this;
    }

    /**
     * Remove idiomasAudio
     *
     * @param \AppBundle\Entity\Pelicula $idiomasAudio
     */
    public function removeIdiomasAudio(\AppBundle\Entity\Pelicula $idiomasAudio)
    {
        $this->idiomas_audios->removeElement($idiomasAudio);
    }

    /**
     * Get idiomasAudios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdiomasAudios()
    {
        return $this->idiomas_audios;
    }

    /**
     * Add idiomasSubtitulo
     *
     * @param \AppBundle\Entity\Pelicula $idiomasSubtitulo
     *
     * @return Idioma
     */
    public function addIdiomasSubtitulo(\AppBundle\Entity\Pelicula $idiomasSubtitulo)
    {
        $this->idiomas_subtitulos[] = $idiomasSubtitulo;

        return $this;
    }

    /**
     * Remove idiomasSubtitulo
     *
     * @param \AppBundle\Entity\Pelicula $idiomasSubtitulo
     */
    public function removeIdiomasSubtitulo(\AppBundle\Entity\Pelicula $idiomasSubtitulo)
    {
        $this->idiomas_subtitulos->removeElement($idiomasSubtitulo);
    }

    /**
     * Get idiomasSubtitulos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdiomasSubtitulos()
    {
        return $this->idiomas_subtitulos;
    }
}

