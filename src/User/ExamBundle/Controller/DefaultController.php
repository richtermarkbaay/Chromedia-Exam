<?php

namespace User\ExamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UserExamBundle:Default:index.html.twig', array('name' => $name));
    }
}

