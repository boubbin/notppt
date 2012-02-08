<?php
namespace goulu\notpowerpointBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SlideRepository extends EntityRepository
{
    public function getBySlideshowId($slideshowid)
    {
        $queryBuilder = $this->createQueryBuilder('slide')
                ->select('slide')
                ->where("slide.slideshowid = $slideshowid")
                ->addOrderBy('slide.slidenumber', 'ASC');
        
       return $queryBuilder->getQuery()
                ->getResult();     
    }
}
?>
