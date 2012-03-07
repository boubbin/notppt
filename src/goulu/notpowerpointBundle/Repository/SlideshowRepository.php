<?php
namespace goulu\notpowerpointBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SlideshowRepository extends EntityRepository
{
    public function getAllSlideshows()
    {
        $queryBuilder = $this->createQueryBuilder('slideshow')
                ->select()
                ->addOrderBy('slideshow.creationdate', 'ASC');
        
       return $queryBuilder->getQuery()
                ->getResult();     
    }
}
?>
