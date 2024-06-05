<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function findNonInscrits($session_id)
    {
        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();

        $qb = $sub;
        // sélectionner tous les apprenants d'une session dont l'id est passé en paramètre
        $qb->select('a')
            ->from('App\Entity\Apprenant', 'a')
            ->leftJoin('a.sessions', 'se')
            ->where('se.id = :id');

        $sub = $em->createQueryBuilder();
        // sélectionner tous les apprenants qui ne SONT PAS (NOT IN) dans le résultat précédent
        // on obtient donc les apprenants non inscrits pour une session définie
        $sub->select('ap')
            ->from('App\Entity\Apprenant', 'ap')
            ->where(($sub->expr()->notIn('ap.id', $qb->getDQL())))
            // requête paramétrée
            ->setParameter('id', $session_id)
            // trier la liste des apprenants sur le nom de famille
            ->orderBy('ap.nom');
        
        // renvoyer le résultat
        $query = $sub->getQuery();
        return $query->getResult();
    }

    public function findNonProgrammedUnites($session_id)
    {
        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();

        // première sous requête : sélectionner toutes les unités programmées pour une session
        $qb = $sub;
        $qb->select('u.id')
            ->from('App\Entity\Unite', 'u')
            ->innerJoin('App\Entity\Programme', 'p', 'WITH', 'u.id = p.unite' )
            ->where('p.session = :id');
        
        // seconde requête : sélectionner toutes les unités qui ne sont pas programmées
        $sub = $em->createQueryBuilder();
        $sub->select('unite')
            ->from('App\Entity\Unite', 'unite')
            ->where($sub->expr()->notIn('unite.id', $qb->getDQL()))
            ->setParameter('id', $session_id)
            //  Trier la liste par intitulé
            ->orderBy('unite.intitule');

        // renvoyer le résultat
        $query = $sub->getQuery();
        return $query->getResult();
    }

    //    /**
    //     * @return Session[] Returns an array of Session objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Session
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
