<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 15.03.18
 * Time: 21:13
 */

namespace lib;

class Paginator

{
    private $totalPages;

    private $page;

    private $rpp;

    public function __construct($page, $totalcount, $rpp)
    {
        $this->rpp=$rpp;
        $this->page=$page;

        $this->totalPages=$this->setTotalPages($totalcount, $rpp);
    }

    private function setTotalPages($totalcount, $rpp)
    {
        if ($rpp == 0)
        {
            $rpp = 20;
        }

        $this->totalPages=ceil($totalcount / $rpp);
        return $this->totalPages;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function getPagesList()
    {
        $pageCount = 5;
        if ($this->totalPages <= $pageCount)
            return array(1, 2, 3, 4, 5);

        if($this->page <=3)
            return array(1,2,3,4,5);

        $i = $pageCount;
        $r=array();
        $half = floor($pageCount / 2);
        if ($this->page + $half > $this->totalPages)
        {
            while ($i >= 1)
            {
                $r[] = $this->totalPages - $i + 1;
                $i--;
            }
            return $r;
        } else
        {
            while ($i >= 1)
            {
                $r[] = $this->page - $i + $half + 1;
                $i--;
            }
            return $r;
        }
    }


}