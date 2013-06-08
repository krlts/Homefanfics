<?php

namespace Hff\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categorias
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hff\BlogBundle\Entity\CategoriasRepository")
 */
class Categorias
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
     * @ORM\Column(name="nombre", type="string", length=45)
     * @Assert\Length(
     *      min = "1",
     *      max = "45",
     *      maxMessage = "El nombre de la Categoría puede tener un largo máximo de 45 carácteres")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     * @Assert\Length(max = "255")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255)
     * @Assert\Length(max = "255")
     */
    private $imagen;

    /**
     * @ORM\OneToMany(targetEntity="Escritos", mappedBy="categoria")
     */
    private $escritos;

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
     * @return Categorias
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Categorias
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Categorias
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    
        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }
    
    public function setEscritos(\Hff\BlogBundle\Entity\Escritos $escritos)
    {
        $this->escritos[] = $escritos;
    }

    public function getCitas()
    {
        return $this->citas;
    }
    
    public function __toString() {
        if($this->getNombre()==NULL)
            return '';
        return $this->getNombre();
    }
    public function __construct() {
        $this->setDescripcion('');
        $this->escritos = new ArrayCollection();
        $this->setImagen('0');
    }
}
