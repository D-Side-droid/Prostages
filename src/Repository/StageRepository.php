<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
	
    /**
	 * @return Stage[] Returns an array of Stage objects
	 */
	 
	public function findByEntreprise($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.entreprises = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

	/**
     * @return Stage[] Returns an array of Stage objects
     */
	 
	public function findByFormationDql($value)
    {
       // Récupérer le gestionnaire d'entité
       $entityManager = $this->getEntityManager();

       // Construction de la requêtemp
       $requete = $entityManager->createQuery(
         'SELECT s
          FROM App\Entity\Stage s
          WHERE s.entreprises = :val'
       );
		setParameter('val',$value);
       // Exécuter la requête et retourner les résultats
       return $requete->execute();
    }
	
	
	
	
    /**
     * @return Stage[] Returns an array of Stage objects
     */

     public function findAllOptimized()
     {
       $gestionnaireEntite = $this->getEntityManager();

       $requete = $gestionnaireEntite->createQuery('SELECT s,e,f FROM App\Entity\Stage s JOIN s.entreprise e JOIN s.formations f');

       return $requete->execute();
     }

}
