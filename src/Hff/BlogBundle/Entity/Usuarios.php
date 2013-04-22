<?php

namespace Hff\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Usuarios
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hff\BlogBundle\Entity\UsuariosRepository")
 */
class Usuarios
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
     * @ORM\Column(name="usuario", type="string", length=40)
     * @Assert\NotNull(message="Debes escribir un nombre de usuario")
     * @Assert\MaxLength(40)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotNull(message="Debes escribir una contraseña")
     * @Assert\MaxLength(255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_real", type="string", length=100)
     * @Assert\NotNull(message="Ingresa tus nombres y apellidos")
     * @Assert\MaxLength(100)
     */
    private $nombreReal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bloqueado", type="boolean")
     */
    private $bloqueado;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     * @Assert\NotNull(message="Debes ingresar tu correo electrónico")
     * @Assert\Email(message = "El email '{{ value }}' no es válido.")
     * @Assert\MaxLength(100)
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enviar_mail", type="boolean")
     */
    private $enviarMail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime")
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ultima_visita", type="datetime")
     */
    private $ultimaVisita;

    /**
     * @var string
     *
     * @ORM\Column(name="ultima_ip", type="string", length=50)
     */
    private $ultimaIp;

    /**
     * @var integer
     *
     * @ORM\Column(name="rol", type="integer")
     */
    private $rol;


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
     * Set usuario
     *
     * @param string $usuario
     * @return Usuarios
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set nombreReal
     *
     * @param string $nombreReal
     * @return Usuarios
     */
    public function setNombreReal($nombreReal)
    {
        $this->nombreReal = $nombreReal;
    
        return $this;
    }

    /**
     * Get nombreReal
     *
     * @return string 
     */
    public function getNombreReal()
    {
        return $this->nombreReal;
    }

    /**
     * Set bloqueado
     *
     * @param boolean $bloqueado
     * @return Usuarios
     */
    public function setBloqueado($bloqueado)
    {
        $this->bloqueado = $bloqueado;
    
        return $this;
    }

    /**
     * Get bloqueado
     *
     * @return boolean 
     */
    public function getBloqueado()
    {
        return $this->bloqueado;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuarios
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set enviarMail
     *
     * @param boolean $enviarMail
     * @return Usuarios
     */
    public function setEnviarMail($enviarMail)
    {
        $this->enviarMail = $enviarMail;
    
        return $this;
    }

    /**
     * Get enviarMail
     *
     * @return boolean 
     */
    public function getEnviarMail()
    {
        return $this->enviarMail;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Usuarios
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    
        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set ultimaVisita
     *
     * @param \DateTime $ultimaVisita
     * @return Usuarios
     */
    public function setUltimaVisita($ultimaVisita)
    {
        $this->ultimaVisita = $ultimaVisita;
    
        return $this;
    }

    /**
     * Get ultimaVisita
     *
     * @return \DateTime 
     */
    public function getUltimaVisita()
    {
        return $this->ultimaVisita;
    }

    /**
     * Set ultimaIp
     *
     * @param string $ultimaIp
     * @return Usuarios
     */
    public function setUltimaIp($ultimaIp)
    {
        $this->ultimaIp = $ultimaIp;
    
        return $this;
    }

    /**
     * Get ultimaIp
     *
     * @return string 
     */
    public function getUltimaIp()
    {
        return $this->ultimaIp;
    }

    /**
     * Set rol
     *
     * @param integer $rol
     * @return Usuarios
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    
        return $this;
    }

    /**
     * Get rol
     *
     * @return integer 
     */
    public function getRol()
    {
        return $this->rol;
    }
}
