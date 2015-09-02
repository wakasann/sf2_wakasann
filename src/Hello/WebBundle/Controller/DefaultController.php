<?php

namespace Hello\WebBundle\Controller;

use Hello\WebBundle\Entity\Book;
use Hello\WebBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{

    /**
     * @Route("/book/show/{id}")
     * @ParamConverter("book",class="HelloWebBundle:Book")
     */
    public function showBookAction(Book $book){
        return new Response($book->getTitle());
    }


    /**
     * @Route("/index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        /** @var $user2 \Hello\WebBundle\Entity\User */
        $user2 = $em->getRepository('HelloWebBundle:User')->findOneBy(array('id'=>1));

//        foreach($user2->getBooks() as $book){
//            echo $book->getTitle()."<br/>";
//        }

//        $user2->setAge(18);
//        $em->persist($user2);
//        $em->flush();

        //新增两本书，并用户是1的两本书
/*        $book1 = new Book();

        $book1->setTitle("一个人的朝圣");
        $book1->setPrice(1)->addUser($user2);

        $book2 = new Book();
        $book2->setTitle("程序员思维");
        $book2->setPrice(16.88)->addUser($user2);
        $em->persist($book1);
        $em->persist($book2);
        $em->flush();*/


      /*  $user = new User();
        $user->setAge(22);
        $user->setEmail('xiaofosong@126.com');
        $user->setPassword('Helloworld');


        $em->persist($user);*/

        //删除
//        $em->remove($user2);
//        $em->flush();



        return array('name' => 'a');
    }
}
