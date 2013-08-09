<?php

namespace Hff\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;


/**
 * Comentarios
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hff\BlogBundle\Entity\ComentariosRepository")
 */
class Comentarios
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
     * @ORM\Column(name="mensaje", type="text")
     */
    private $mensaje;

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
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer")
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="escrito", type="integer")
     */
    private $escrito;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="emisor", type="integer")
     */
    private $emisor;

    /**
     * @ORM\ManyToOne(targetEntity="\Hff\BlogBundle\Entity\Usuarios")
     */
    private $usuario;

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
     * Set mensaje
     *
     * @param string $mensaje
     * @return Comentarios
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string 
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Comentarios
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
     * @return Comentarios
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
     * Set estado
     *
     * @param integer $estado
     * @return Comentarios
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set escrito
     *
     * @return Comentarios
     */
    public function setEscrito( $escrito)
    {
        $this->escrito = $escrito;

        return $this;
    }

    /**
     * Get escrito
     *
     * @return integer 
     */
    public function getEscrito()
    {
        return $this->escrito;
    }
    
    /**
     * Set emisor
     *
     * @return Comentarios
     */
    public function setEmisor( $emisor)
    {
        $this->emisor = $emisor;

        return $this;
    }

    /**
     * Get emisor
     *
     * @return integer 
     */
    public function getEmisor()
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
        return $this->emisor;
    }
    
    
    /**
     * ORM\ManyToOne(targetEntity="Usuarios", inversedBy="comentarios")
     */
    public function setUsuario(\Hff\BlogBundle\Entity\Usuarios $usuario)
    {
        $this->usuario = $usuario;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }
    
    public function __toString() {
        if($this->getMensaje()==NULL)
            return '';
        return $this->getMensaje();
    }
    public function __construct() {
        $this->setFechaCreacion(new \DateTime());
        $this->setFechaModificacion(new \DateTime());
        $this->setEstado(1);
        $this->setMensaje('');
        $this->setEscrito(0);
        $this->setEmisor(0);
    }
}
