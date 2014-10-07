<?php
namespace User\ExamBundle\Controller;
session_start();

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\ExamBundle\Entity\UserManagement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class AuthController extends Controller
{ 
    public function userloginAction(Request $request){
        $location = '';
       $user = new UserManagement();
       
       $request = Request::createFromGlobals();
        $data = $request->request->get('form');
        
        $email = trim($data['email']);
        $password = trim($data['password']);
        $fpass = crypt($password);

            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                "SELECT u
                FROM UserExamBundle:UserManagement u
                WHERE u.email = '$email' and u.password = '$password'");
            $ulogin = $query->getResult();

            if(count($ulogin)>0){

              print "<pre>";
                    print_r($ulogin);
              print "</pre>";



            foreach ($ulogin as $result) {
                echo $result->email; 
                echo "<br>";
            } 


                $msg = "Success!";


            }else{
                $msg="Fail";

            }

     return new Response($msg);
     //return $this->render($location);   
    }
}