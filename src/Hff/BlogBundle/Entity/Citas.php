<?php

namespace Hff\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Citas
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hff\BlogBundle\Entity\CitasRepository")
 */
class Citas
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
     * @ORM\Column(name="texto", type="string", length=255)
     */
    private $texto;

    /**
     * @var integer
     *
     * @ORM\Column(name="idAutor", type="integer")
     */
    private $idAutor;


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
     * Set texto
     *
     * @param string $texto
     * @return Citas
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    
        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set idAutor
     *
     * @param integer $idAutor
     * @return Citas
     */
    public function setIdAutor($idAutor)
    {
        $this->idAutor = $idAutor;
    
        return $this;
    }

    /**
     * Get idAutor
     *
     * @return integer 
     */
    public function getIdAutor()
    {
        return $this->idAutor;
    }
    /**
     * @ORM\ManyToOne(targetEntity="Autores", inversedBy="citas")
     * @ORM\JoinColumn(name="idAutor", referencedColumnName="id")
     */
    //* @return integer
    private $autor;
    public function setAutor(\Hff\BlogBundle\Entity\Autores $autor)
    {
        $this->autor = $autor;
    }

    public function getAutor()
    {
        return $this->autor;
    }
    
    public function __toString()
    {
        return $this->getNombre();
    }
}
    