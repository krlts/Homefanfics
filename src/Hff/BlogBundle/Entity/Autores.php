<?php

namespace Hff\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Autores
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hff\BlogBundle\Entity\AutoresRepository")
 */
class Autores
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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;
    
    /**
     * @ORM\OneToMany(targetEntity="Citas", mappedBy="autor")
     */
    private $citas;


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
     * @return Autores
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
    
    public function __construct()
    {
        $this->citas = new ArrayCollection();
        $this->setNombre('');
    }
    public function setCitas(\Hff\BlogBundle\Entity\Citas $citas)
    {
        $this->citas[] = $citas;
    }

    public function getCitas()
    {
        return $this->citas;
    }
    
    public function __toString()
    {
        return $this->getNombre();
    }

}
