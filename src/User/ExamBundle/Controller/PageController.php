<?php

namespace User\ExamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\ExamBundle\Entity\UserManagement;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
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
