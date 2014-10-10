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

          try{

                    $em = $this->getDoctrine()->getManager();
                    $query = $em->createQuery(
                        "SELECT u
                        FROM UserExamBundle:UserManagement u
                        WHERE u.email = '$email' and u.password = '$fpass'");
                    $ulogin = $query->getResult();

                    if(count($ulogin)>0){

                        foreach ($ulogin as $result) {

                            if($result->getStatus() == trim('inactive')) {
                                 return $this->redirect('login');
                            }else{

                                $session = new Session();
                                $session->start();
                                // set all sessions
                                $session->set('id', $result->getId());
                                $session->set('firstname', $result->getFirstname());
                                $session->set('email', $result->getEmail());
                                $session->set('lastname', $result->getLastname());
                                $session->set('password', $result->getPassword());

                                return $this->redirect('profile');

                            }
                        } 

                    }else{
                        return $this->redirect('login');
                    }

            }catch(\Doctrine\DBAL\DBALException $e) {

                                $this->get('session')->getFlashBag()->add('error', 'Somethings problem with your data, not authenticating!');

                            }
    }

     //logout
    public function logoutAction(){
       $session = new Session();

       try{

                  return $this->redirect('login');
 
       }catch(\Doctrine\DBAL\DBALException $e) {

           $this->get('session')->getFlashBag()->add('error', 'The session setting is not unset!');

       }

    }
}