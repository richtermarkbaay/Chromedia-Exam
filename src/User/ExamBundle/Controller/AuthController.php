<?php
namespace User\ExamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\ExamBundle\Entity\UserManagement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

use Symfony\Component\HttpFoundation\Session\Session; 

class AuthController extends Controller
{ 
    public function userloginAction(Request $request){
       $user = new UserManagement();
       
       $request = Request::createFromGlobals();
        $data = $request->request->get('form');
        
        $email = trim($data['email']);
        $password = trim($data['password']);
        $fpass = sha1($password);

            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                "SELECT u
                FROM UserExamBundle:UserManagement u
                WHERE u.email = '$email' and u.password = '$fpass'");
            $ulogin = $query->getResult();

            if(count($ulogin)>0){
              $session = new Session();
              $session->start();

              foreach ($ulogin as $result) {
                                
                  $session->set('id', $result->getId());
                  $session->set('firstname', $result->getFirstname());
                  $session->set('email', $result->getEmail());
                  $session->set('lastname', $result->getLastname());
                  $session->set('password', $result->getPassword());
                  
                  $ret = 'profile';
              } 

            }else{
            //  $session->set('error', 'Invalid username / password');
                return $this->redirect('login');
            }
      return $this->redirect($ret);
    }

    //send email
    public function indexAction($name)
    {/*
        $session = new Session();
        $email = $session->get('email');

        $message = \Swift_Message::newInstance()
            ->setSubject('Email Confirmation')
            ->setFrom('send@example.com')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    'UserExamBundle:Page:profile.html.twig',
                    array('name' => $name)
                )
            )
        ;
        $this->get('mailer')->send($message);

        return $this->render('');
        */
    }

     //logout
    public function logoutAction(){
       $session = new Session();

         // $session->remove('id');
              return $this->redirect('login');
    }
}