<?php

namespace AppBundle\Repository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByCreatedAtNow() {
        // faire des conditions plus complexe
        // SELECT * FROM Article WHERE
        //
        // created_at >= '2018-08-20 00:00:00'
        // AND created_at <= '2018-08-20 23:59:59'

        // created_at BETWEEN '2018-08-20 00:00:00'
        // AND '2018-08-20 23:59:59'

        // created_at LIKE '2018-08-20%'
        $qb = $this->createQueryBuilder('a');

        $now = date('Y-m-d');
        $qb->where('a.createdAt LIKE :createdAt')
            ->setParameter('createdAt', $now.'%')
        ;

        $query = $qb->getQuery();
        $results = $query->getResult();

        return $results;
    }

    public function findByTitleAndEnabled() {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.enabled = :enabled')
            ->setParameter('enabled', false)
            ->andWhere('a.title = :title OR a.title = :title2')
            ->setParameter('title', 'titre')
            ->setParameter('title2', 'nouvel article')
        ;

        $query = $qb->getQuery();
        $results = $query->getResult();

        return $results;
    }

    public function findId3Createdat082018() {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.id > 3');
        $qb->andWhere("a.createdAt LIKE '2018-08-%'");

        return $qb->getQuery()->getResult();
    }

    public function findByEnabled2018() {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.enabled = :enabled');
        $qb->setParameter('enabled', true);
        $qb->andWhere("a.createdAt LIKE '2018-%'");

        return $qb->getQuery()->getResult();
    }

    public function findByYear($year) {
        $qb = $this->createQueryBuilder('a');

        $qb->where("a.createdAt LIKE :param");
        $qb->setParameter('param', $year.'%');

        return $qb->getQuery()->getResult();
    }

    public function findByYearOrderedTitle($year) {
        $qb = $this->createQueryBuilder('a');

        $qb->where("a.createdAt LIKE :param");
        $qb->setParameter('param', $year.'%');
        $qb->orderBy('a.title', 'ASC');

        return $qb->getQuery()->getResult();
    }

    public function findOneByProperty() {
        $qb = $this->createQueryBuilder('a');

        $query = $qb->getQuery();

        // récupérer un seul résultat
        // object : null si pas de résultat
        // object : un objet si un ou plusieurs
        $object = $query->getSingleResult();

        // récupérer une seule valeur
        // exceptions lancée si 0 ou plusieurs valeurs retournées
        $scalarValue = $query->getSingleScalarResult();

        // récupérer plusieurs enregistrements avec une seule valeur
        // tableau de valeurs scalaires
        $scalarValues = $query->getScalarResult();
    }
}
