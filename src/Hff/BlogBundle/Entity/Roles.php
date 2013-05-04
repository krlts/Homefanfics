<?php

namespace Hff\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Roles
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
     * @ORM\Column(name="nombre", type="string", length=40)
     */
    private $nombre;
    
    /**
     * @ORM\OneToMany(targetEntity="Usuarios", mappedBy="rol")
     */
    private $usuarios;
     public function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }
    public function setUsuarios(\Hff\BlogBundle\Entity\Usuarios $usuarios)
    {
        $this->usuarios[] = $usuarios;
    }

    public function getUsuarios()
    {
        return $this->usuarios;
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
     * @ORM\OneToMany(targetEntity="Usuarios", mappedBy="rol")
     * @return Roles
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
     public function __toString()
    {
        return $this->getNombre();
    }
}
