<?php
namespace User\ExamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\ExamBundle\Entity\UserManagement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Session\Session; 

class PageController extends Controller
{   
    //profile
    public function profileAction(){

        $page = 'profile'; $actionName = 'save'; $action = 'update';
        return $this->formbuilderAction($page, $action, $actionName);
    }

    //sign up
    public function signupAction()
    {
        $page = 'signup'; $action = 'save'; $actionName = 'Save';
        return $this->formbuilderAction($page, $action, $actionName);
    }

    //login
    public function loginAction()
    {      
        $page = 'login'; $action = 'login'; $actionName = 'Login';
      return $this->formbuilderAction($page, $action, $actionName);
    }

    public function formbuilderAction($page, $action, $actionName){
         $user = new UserManagement();
                   $form = $this->createFormBuilder($user)
                          ->add('id', 'text')
                           ->add('email', 'email')
                            ->add('firstname', 'text')
                              ->add('lastname', 'text')
                              //password forms
                                ->add('password', 'password')
                                  ->add('conpass', 'password')
                                    ->add('newpass', 'password')

                          ->add($action, 'submit', array('label' => $actionName))
                          ->getForm();

        return $this->render('UserExamBundle:Page:'.$page.'.html.twig', array(
                                                            'form1' => $form->createView(),
                                                            'form2' => $form->createView(),
         ));  
    }
    public function querycountidAction(){

        $session = new Session();
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery("SELECT count(u.id) FROM UserExamBundle:UserManagement u");
                $count = $query->getSingleScalarResult();
                //$count = $query->getResult(Query::HYDRATE_SINGLE_SCALAR);

                $count = $count + 1;
                return $count;

                $session->set('count', $count);
    }

}
