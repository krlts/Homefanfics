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
     * @ORM\ManyToOne(targetEntity="\Hff\BlogBundle\Entity\Autores")
     */
    private $autor;


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
     * @ORM\ManyToOne(targetEntity="Autores", inversedBy="citas")
     */
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
        return $this->getTexto();
    }
}
    