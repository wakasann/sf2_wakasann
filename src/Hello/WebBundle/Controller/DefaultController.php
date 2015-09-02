<?php

namespace Hello\WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Hello\WebBundle\Entity\Book;
use Hello\WebBundle\Entity\User;
use Hello\WebBundle\Entity\Profile;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{

    /**
     * @Route("/index")
     * @Template()
     */
    public function indexAction()
    {
        $user = new User();
        $builder = $this->createFormBuilder($user);
        //form中添加user对应的profile
        $form = $builder
                ->add('email')
                ->add('password')
                ->add('age')
                ->add(
                    $builder->create('profile','form')
                        ->add('phone_number','integer')
                )
                ->add('Submit','submit')
                ->getForm();
        //处理form的请求
        $form->handleRequest($this->getRequest());

        //假如表单验证成功
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return array('name' => 'a','form'=>$form->createView());
    }
}
