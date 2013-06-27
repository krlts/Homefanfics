<?php

namespace Hff\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ComentariosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ComentariosRepository extends EntityRepository
{
    public function findPublicados($escrito)
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT c FROM HffBlogBundle:Comentarios c WHERE c.escrito = :escrito AND c.estado = :publicado';
        $query = $em->createQuery($dql)
                ->setParameter('escrito', $escrito)
                ->setParameter('publicado', 1);
        return $query->getResult();
    }
    public function findPublicadosByEmisor($emisor)
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT c FROM HffBlogBundle:Comentarios c WHERE c.emisor = :emisor AND c.estado = :publicado';
        $query = $em->createQuery($dql)
                ->setParameter('emisor', $emisor)
                ->setParameter('publicado', 1);
        return $query->getResult();
    }
    public function findOneByEmisor($emisor)
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT c FROM HffBlogBundle:Comentarios c WHERE c.emisor = :emisor AND c.estado = :publicado';
        $query = $em->createQuery($dql)
                ->setParameter('emisor', $emisor)
                ->setParameter('publicado', 1);
        return $query->getResult();
    }
}
