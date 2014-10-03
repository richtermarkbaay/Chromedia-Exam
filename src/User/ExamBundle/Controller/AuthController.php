<?php
namespace User\ExamBundle\Controller;

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

       $request = Request::createFromGlobals();
        $data = $request->request->get('form');

        $email = trim($data['email']);
        $password = trim($data['password']);
        
        $em = $this->getDoctrine();
        $repo  = $em->getRepository("UserExamBundle:UserManagement"); 
        $user = $repo->loadUserByEmail($email);
        if (!$user) {
            throw new UsernameNotFoundException("Email not found");
        } else {
            $token = new UsernamePasswordToken($user, null, "your_firewall_name", $user->getRoles());
            $this->get("security.context")->setToken($token); //now the user is logged in
             
            //now dispatch the login event
            $request = $this->get("request");
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
        }
    }
}