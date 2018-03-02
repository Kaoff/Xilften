<?php

namespace AppBundle\Repository;

/**
 * TVShowRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TVShowRepository extends \Doctrine\ORM\EntityRepository
{
    function searchTVShowsByName(string $search)
    {
        $qb = $this->createQueryBuilder('s')
            ->where("s.name like :search")
            ->setParameter('search', '%' . $search . '%');

        return $qb
            ->getQuery()
            ->getResult();
    }
}