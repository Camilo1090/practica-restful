<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pelicula
 *
 * @ORM\Table(name="pelicula")
 * @ORM\Entity
 */
class Pelicula
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
     * @var string
     *
     * @ORM\Column(name="resumen", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $resumen;

    /**
     * @var string
     *
     * @ORM\Column(name="url_trailer", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $url_trailer;

    /**
     * @var \AppBundle\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pais", inversedBy="peliculas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     * })
     */
    private $pais;

    /**
     * @var \AppBundle\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categoria", inversedBy="peliculas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Actor", mappedBy="peliculas")
     */
    private $actores;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Idioma", inversedBy="idiomas_audios")
     * @ORM\JoinTable(name="pelicula_idioma",
     *   joinColumns={
     *     @ORM\JoinColumn(name="pelicula_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idioma_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $audios;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Idioma", mappedBy="idiomas_subtitulos")
     */
    private $subtitulos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->audios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subtitulos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Pelicula
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
     * Set resumen
     *
     * @param string $resumen
     *
     * @return Pelicula
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return string
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set urlTrailer
     *
     * @param string $urlTrailer
     *
     * @return Pelicula
     */
    public function setUrlTrailer($urlTrailer)
    {
        $this->url_trailer = $urlTrailer;

        return $this;
    }

    /**
     * Get urlTrailer
     *
     * @return string
     */
    public function getUrlTrailer()
    {
        return $this->url_trailer;
    }

    /**
     * Set pais
     *
     * @param \AppBundle\Entity\Pais $pais
     *
     * @return Pelicula
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
     * Set categoria
     *
     * @param \AppBundle\Entity\Categoria $categoria
     *
     * @return Pelicula
     */
    public function setCategoria(\AppBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Add actore
     *
     * @param \AppBundle\Entity\Actor $actore
     *
     * @return Pelicula
     */
    public function addActore(\AppBundle\Entity\Actor $actore)
    {
        $this->actores[] = $actore;

        return $this;
    }

    /**
     * Remove actore
     *
     * @param \AppBundle\Entity\Actor $actore
     */
    public function removeActore(\AppBundle\Entity\Actor $actore)
    {
        $this->actores->removeElement($actore);
    }

    /**
     * Get actores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActores()
    {
        return $this->actores;
    }

    /**
     * Add audio
     *
     * @param \AppBundle\Entity\Idioma $audio
     *
     * @return Pelicula
     */
    public function addAudio(\AppBundle\Entity\Idioma $audio)
    {
        $this->audios[] = $audio;

        return $this;
    }

    /**
     * Remove audio
     *
     * @param \AppBundle\Entity\Idioma $audio
     */
    public function removeAudio(\AppBundle\Entity\Idioma $audio)
    {
        $this->audios->removeElement($audio);
    }

    /**
     * Get audios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAudios()
    {
        return $this->audios;
    }

    /**
     * Add subtitulo
     *
     * @param \AppBundle\Entity\Idioma $subtitulo
     *
     * @return Pelicula
     */
    public function addSubtitulo(\AppBundle\Entity\Idioma $subtitulo)
    {
        $this->subtitulos[] = $subtitulo;

        return $this;
    }

    /**
     * Remove subtitulo
     *
     * @param \AppBundle\Entity\Idioma $subtitulo
     */
    public function removeSubtitulo(\AppBundle\Entity\Idioma $subtitulo)
    {
        $this->subtitulos->removeElement($subtitulo);
    }

    /**
     * Get subtitulos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubtitulos()
    {
        return $this->subtitulos;
    }
}

