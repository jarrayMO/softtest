<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Entity\Link;
use App\Entity\Material;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Link>
 *
 * @method Link|null find($id, $lockMode = null, $lockVersion = null)
 * @method Link|null findOneBy(array $criteria, array $orderBy = null)
 * @method Link[]    findAll()
 * @method Link[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Link::class);
    }

    public function add(Link $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Link $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return float|int|mixed|string
     */
    public function findByCountMaterial()
    {
        return $this->createQueryBuilder('l')
            ->innerJoin(Customer::class, 'c','WITH', 'c.id = l.customer')
            ->innerJoin(Material::class, 'm','WITH', 'm.id = l.material')
            ->select('c.lastName, c.name,c.email,SUM(m.price) as sumPrice, COUNT(DISTINCT(l.material)) as countMateriel')
            ->groupBy('c.id')
            ->having('countMateriel >= 30')
            ->andHaving('sumPrice>=30000')
            ->orderBy('c.id')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByTotalPriceCustomer()
    {
        return $this->createQueryBuilder('l')
            ->innerJoin(Customer::class, 'c','WITH', 'c.id = l.customer')
            ->innerJoin(Material::class, 'm','WITH', 'm.id = l.material')
            ->select('c.lastName, c.name,c.email,SUM(m.price) as sumPrice, COUNT(DISTINCT(l.material)) as countMateriel')
            ->groupBy('c.id')
            ->orderBy('c.id')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findMaxTotalPriceCustomer(){
        return $this->createQueryBuilder('l')
            ->innerJoin(Customer::class, 'c','WITH', 'c.id = l.customer')
            ->innerJoin(Material::class, 'm','WITH', 'm.id = l.material')
            ->select('c.lastName, c.name,c.email,SUM(m.price) as sumPrice')
            ->groupBy('c.id')
            ->orderBy('sumPrice' ,'DESC')
            ->getQuery()
            ->setMaxResults(1)
            ->getResult();
    }

//    /**
//     * @return Link[] Returns an array of Link objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Link
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
