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
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route("/myresult")
     * @Template()
     */
    public function myrequestAction(){

        $request = Request::createFromGlobals();

// the URI being requested (e.g. /about) minus any query parameters
        echo $request->getPathInfo();


// retrieve GET and POST variables respectively
        $request->query->get('foo');
        $request->request->get('bar', 'default value if bar does not exist');

// retrieve SERVER variables
        $request->server->get('HTTP_HOST');

// retrieves an instance of UploadedFile identified by foo
        $request->files->get('foo');

// retrieve a COOKIE value
        $request->cookies->get('PHPSESSID');

// retrieve an HTTP request header, with normalized, lowercase keys
        $request->headers->get('host');
        $request->headers->get('content_type');

        $request->getMethod();    // GET, POST, PUT, DELETE, HEAD
        $request->getLanguages(); // an array of languages the client accepts

        return array();
    }

}
