<?php
 // print_r($data); die(); 
namespace User\ExamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\ExamBundle\Entity\UserManagement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SaveController extends Controller
{
    public function saveAction(Request $request)
    {
        $request = Request::createFromGlobals();
                $data = $request->request->get('form');

                $user = new UserManagement();

                $user->setEmail($data['email']);
                $user->setFirstname($data['firstname']);
                $user->setLastname($data['lastname']);
                $user->setPassword($data['password']);
                $user->setConpass($data['conpass']);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
      
        return new Response('New Account created '.$data['firstname']." ".$data['lastname']);
    }
}