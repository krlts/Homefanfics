<?php

namespace Hff\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Role\Role;

/**
 * Grupos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hff\BlogBundle\Entity\GruposRepository")
 */
class Grupos extends Role{
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
     * @ORM\Column(name="nombre", type="string", length=30)
     */
    private $nombre;
    
    /**
     * @ORM\Column(name="roles", type="string", length=30, unique=true)
     */
    private $roles;
    
    /**
     * @ORM\ManyToMany(targetEntity="Usuarios", mappedBy="grupos")
     */
    private $usuarios;

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
     * @return Grupos
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
     * @param string $rol
     *
     * @return Grupos
     */
    public function agregarRol($rol)
    {
        if (!$this->tieneRol($rol)) {
            $this->roles[] = strtoupper($rol);
        }

        return $this;
    }
    public function tieneRol($rol)
    {
        return in_array(strtoupper($rol), $this->roles, true);
    }
    /**
     * Get roles
     *
     * @return roles
     */
    public function getRoles()
    {
        return $this->roles;
    }
     /**
     * @param array $roles
     *
     * @return Grupos
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }
     /**
     * @param string $rol
     *
     * @return Grupos
     */
    public function quitarRol($rol)
    {
        if (false !== $key = array_search(strtoupper($rol), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }

        return $this;
    }
    /*public function __construct($nombre, $roles = array())
    {
        $this->nombre = $nombre;
        $this->roles = $roles;
        $this->usuarios = new ArrayCollection();
    }*/
    public function __construct()
    {
        $this->nombre = '';
        $this->roles = '';
        $this->usuarios = new ArrayCollection();
    }
}
?>
