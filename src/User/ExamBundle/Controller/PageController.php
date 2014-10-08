<?php
namespace User\ExamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\ExamBundle\Entity\UserManagement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Session\Session; 

class PageController extends Controller
{   
    public function profileAction(Request $request){

            $session = new Session();
            //$session->start();
            $id = $session->get('id');

            echo $id; 

            $user = new UserManagement();
            
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                "SELECT u
                FROM UserExamBundle:UserManagement u
                WHERE u.id = '$id'");
            $fet = $query->getResult(); 
    
            if(count($fet)>0){

                foreach($fet as $row){

                      $f = $row->getFirstname();
                      $i = $row->getId();
                      $e = $row->getEmail();  
                      $l = $row->getLastname();
                      $n = $row->getFirstname()." ".$row->getLastname(); 
                      $p = $row->getPassword();

                }

                   $form = $this->createFormBuilder($user)
                          ->add('id', 'text')
                          ->add('email', 'email')
                          ->add('firstname', 'text')
                          ->add('lastname', 'text')
                          ->add('password', 'password')
                          ->add('update', 'submit', array('label' => 'Update Account'))
                          ->getForm();

                            return $this->render('UserExamBundle:Page:profile.html.twig', array(
          'email' => $e, 
           'id' => $i, 
            'name' => $n, 
             'password' => $p, 
               'fname' => $f,
                  'lname' => $l,
                'form' => $form->createView(),
          ));  

            }else
            { echo "fail!"; }
            
    }

    //sign up
    public function signupAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $user = new UserManagement();
        $form = $this->createFormBuilder($user)
            ->add('email', 'email')
            ->add('firstname', 'text')
            ->add('lastname', 'text')
            ->add('password', 'password')
            ->add('conpass', 'password')
            ->add('save', 'submit', array('label' => 'Sign Up'))
            ->getForm();

        //return to page
        return $this->render('UserExamBundle:Page:signup.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    //login
    public function loginAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $user = new UserManagement();
        $form = $this->createFormBuilder($user)
            ->add('email', 'email')
            ->add('password', 'password')
            ->add('login', 'submit', array('label' => 'Login'))
            ->getForm();
  
        //return to page
        return $this->render('UserExamBundle:Page:login.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
