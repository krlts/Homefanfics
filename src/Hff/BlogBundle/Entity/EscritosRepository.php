<?php

namespace Hff\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EscritosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EscritosRepository extends EntityRepository
{
    public function findAllTitulos()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT e FROM HffBlogBundle:Escritos e ORDER BY e.titulo ASC')
            ->getResult();
    }
    
    public function findAllTitulosDesc()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT e FROM HffBlogBundle:Escritos e ORDER BY e.titulo DESC')
            ->getResult();
    }
    public function findAllRecientes()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT e FROM HffBlogBundle:Escritos e ORDER BY e.id DESC')
            ->getResult();
    }
    public function findAllByUsuario($usuario)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT e FROM HffBlogBundle:Escritos e WHERE e.usuario = :usuario ORDER BY e.id DESC')
            ->setParameters(array('usuario' => $usuario))
            ->getResult();
    }
    public function findAllByCategoria($categoria)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT e FROM HffBlogBundle:Escritos e WHERE e.categoria = :categoria ORDER BY e.id DESC')
            ->setParameters(array('categoria' => $categoria))
            ->getResult();
    }
    public function findAllMasComentados()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT e FROM HffBlogBundle:Escritos e ORDER BY e.totalComentarios DESC')
            ->getResult();
    }
    public function findAllMasVistos()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT e FROM HffBlogBundle:Escritos e ORDER BY e.totalVistas DESC')
            ->getResult();
    }
    
  
}
