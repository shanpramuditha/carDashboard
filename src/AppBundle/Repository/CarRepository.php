<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CarRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CarRepository extends EntityRepository
{
    public function search($fuel,$wheels,$price,$doors,$speed,$convertable){
        $qb = $this->createQueryBuilder('o');
        $qb->select('o');
        if($fuel != null or $fuel != "") {
            $qb->where('o.fuel = :fuel')
                ->setParameter('fuel', $fuel);
        }
        if($wheels != null or $wheels != "") {
            $qb->andWhere('o.wheels = :wheels')
                ->setParameter('wheels', $wheels);
        }
        if($doors != null or $doors != ""){
            $qb->andWhere('o.doors = :doors')
                ->setParameter('doors',$doors);
        }
        if($convertable == "on"){
            $qb->andWhere('o.convertable = :convertable')
                ->setParameter('convertable',true);
        }
        if(count($price) == 2){
            $qb->andWhere(
                $qb->expr()->between(
                    'o.price',
                    ':low',
                    ':high'
                )
            )
                ->setParameter('low', floatval($price[0]))
                ->setParameter('high', floatval($price[1]));
        }
        if(count($speed) == 2){
            $qb->andWhere(
                $qb->expr()->between(
                    'o.topSpeed',
                    ':lowSpeed',
                    ':highSpeed'
                )
            )
                ->setParameter('lowSpeed', floatval($speed[0]))
                ->setParameter('highSpeed', floatval($speed[1]));
        }
        return $qb->getQuery()->getResult();
    }
}
