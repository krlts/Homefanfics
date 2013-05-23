<?php

namespace Hff\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Escritos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hff\BlogBundle\Entity\EscritosRepository")
 */
class Escritos
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
     * @ORM\Column(name="titulo", type="string", length=255)
     * @Assert\NotNull(message="Debes escribir un título a tu escrito")
     * @Assert\MaxLength(255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Assert\MaxLength(255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="text")
     */
    private $intro;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text")
     * @Assert\NotNull(message="Debes ingresar el contenido de tu escrito")
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Tags", mappedBy="escrito")
     * @Assert\MaxLength(40)
     * 
     */
    private $tags;

    /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="Comentarios", mappedBy="escrito")
     */       
    private $comentarios;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="\Hff\BlogBundle\Entity\Categorias")
     * @Assert\NotNull(message="Selecciona la Categoría de tu escrito")
     */
    private $categoria;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publicado", type="boolean")
     */
    private $publicado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime")
     */
    private $fechaModificacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="comentariosHabilitados", type="boolean")
     */
    private $comentariosHabilitados;

    /**
     * @var integer
     *
     * @ORM\Column(name="totalComentarios", type="integer")
     */
    private $totalComentarios;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="\Hff\BlogBundle\Entity\Escritores")
     */
    private $escritor;

    /**
     * @var integer
     *
     * @ORM\Column(name="totalVisitas", type="integer")
     */
    private $totalVisitas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicioPublicacion", type="datetime")
     */
    private $inicioPublicacion;


    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->tags = new ArrayCollection();
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
     * Set titulo
     *
     * @param string $titulo
     * @return Escritos
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Escritos
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set intro
     *
     * @param string $intro
     * @return Escritos
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string 
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     * @return Escritos
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string 
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Escritos
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set comentarios
     *
     * @param integer $comentarios
     * @return Escritos
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios
     *
     * @return integer 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set categoria
     *
     * @ORM\ManyToOne(targetEntity="Categorias", inversedBy="escritos")
     * @param integer $categoria
     * @return Escritos
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return integer 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set publicado
     *
     * @param boolean $publicado
     * @return Escritos
     */
    public function setPublicado($publicado)
    {
        $this->publicado = $publicado;

        return $this;
    }

    /**
     * Get publicado
     *
     * @return boolean 
     */
    public function getPublicado()
    {
        return $this->publicado;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Escritos
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Escritos
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set comentariosHabilitados
     *
     * @param boolean $comentariosHabilitados
     * @return Escritos
     */
    public function setComentariosHabilitados($comentariosHabilitados)
    {
        $this->comentariosHabilitados = $comentariosHabilitados;

        return $this;
    }

    /**
     * Get comentariosHabilitados
     *
     * @return boolean 
     */
    public function getComentariosHabilitados()
    {
        return $this->comentariosHabilitados;
    }

    /**
     * Set totalComentarios
     *
     * @param integer $totalComentarios
     * @return Escritos
     */
    public function setTotalComentarios($totalComentarios)
    {
        $this->totalComentarios = $totalComentarios;

        return $this;
    }

    /**
     * Get totalComentarios
     *
     * @return integer 
     */
    public function getTotalComentarios()
    {
        return $this->totalComentarios;
    }

    /**
     * Set escritor
     *
     * @ORM\ManyToOne(targetEntity="Escritores", inversedBy="escritos")
     * @param integer $escritor
     * @return Escritos
     */
    public function setEscritor(\Hff\BlogBundle\Entity\Escritores $escritor)
    {
        $this->escritor = $escritor;

        return $this;
    }

    /**
     * Get escritor
     *
     * @return integer 
     */
    public function getEscritor()
    {
        return $this->escritor;
    }

    /**
     * Set totalVisitas
     *
     * @param integer $totalVisitas
     * @return Escritos
     */
    public function setTotalVisitas($totalVisitas)
    {
        $this->totalVisitas = $totalVisitas;

        return $this;
    }

    /**
     * Get totalVisitas
     *
     * @return integer 
     */
    public function getTotalVisitas()
    {
        return $this->totalVisitas;
    }

    /**
     * Set inicioPublicacion
     *
     * @param \DateTime $inicioPublicacion
     * @return Escritos
     */
    public function setInicioPublicacion($inicioPublicacion)
    {
        $this->inicioPublicacion = $inicioPublicacion;

        return $this;
    }

    /**
     * Get inicioPublicacion
     *
     * @return \DateTime 
     */
    public function getInicioPublicacion()
    {
        return $this->inicioPublicacion;
    }
}
