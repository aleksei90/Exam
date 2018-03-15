<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 15.03.18
 * Time: 21:16
 */

namespace Krychenko\BlogBundle\Tests\lib;

use \lib\Paginator;

class PaginatorTest
{
    public function testgetPageList()
    {
        $paginator = new Paginator(2, 101, 10);
        $pages = $paginator->getTotalPages();
        $this->assertEquals($pages, 11);
        $list = $paginator->getPagesList();
        $this->assertEquals($list, array(1, 2, 3, 4, 5));

        $paginator = new Paginator(7, 101, 10);
        $list = $paginator->getPagesList();
        $this->assertEquals($list, array(5, 6, 7, 8, 9));

        $paginator = new Paginator(10, 101, 10);
        $list = $paginator->getPagesList();
        $this->assertEquals($list, array(7, 8, 9, 10, 11));
    }


    public function listAction($page, $key, $type)
    {
        $em = $this->getDoctrine()->getManager();
        $rpp = $this->container->getParameter('books_per_page');

        $repo = $em->getRepository('trrsywxBundle:BookBook');

        list($res, $totalcount) = $repo->getResultAndCount($page, $rpp, $key, $type);

        $paginator = new \lib\Paginator($page, $totalcount, $rpp);
        $pagelist = $paginator->getPagesList();

        return $this->render('trrsywxBundle:Books:List.html.twig', array('res' => $res, 'paginator' => $pagelist, 'cur' => $page, 'total' => $paginator->getTotalPages(), 'key' => $key, 'type' => $type));
    }
}

?>