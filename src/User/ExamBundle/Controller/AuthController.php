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

            $session = new Session();
            $session->start();
            
            if(count($ulogin)>0){

              foreach ($ulogin as $result) {
                  $i = $result->getId();   

                                
                  $session->set('id', $i);

                  $ret = 'profile';
              } 

            }else{
                $ret="Fail to login account!";
            }
      return $this->redirect($ret);
        //return new Response('id is '.$i);
    }

     //logout
    public function logoutAction(){

        if(!isset($_SESSION['email'])){
            $response = 'UserExamBundle:Page:login.html.twig';
        }else{
                unset($_SESSION['email']);
                $response = 'UserExamBundle:Page:login.html.twig';
        }
        
     return $this->render($response);


    }
}