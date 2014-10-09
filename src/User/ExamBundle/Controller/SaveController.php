<?php
 // print_r($data); die(); 
namespace User\ExamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\ExamBundle\Entity\UserManagement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Session\Session; 
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
                $fpass = sha1($data['password']);

                $user->setPassword($fpass);
               // $user->setConpass($data['conpass']);
                $user->setConpass($fpass);
                $stat = "inactive";
                $user->setStatus($stat);


                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
      
        return new Response('New Account created '.$data['firstname']." ".$data['lastname']);
    }

    public function updateAction(Request $request){

        $data = $request->request->get('form');
        $idtoupdate = $data['id'];

        $user = new UserManagement();

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserExamBundle:UserManagement')->find($idtoupdate);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$idtoupdate
            );
        }
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $em->flush();

        return $this->redirect('profile');

    }

    public function changepasswordAction(Request $request){
        $data = $request->request->get('form');
        $passdata = sha1($data['password']);
        $newpassdata = $data['newpass'];
        $conpassdata = $data['conpass'];

        $session = new Session();
        $id = $session->get('id');
        $pass = $session->get('password');


        if($passdata != $pass){
                return $this->render("Invalid current data!");
        }else if($newpassdata != $conpassdata){
                 return $this->render("Please confirm password!");
        }else{

                $user = new UserManagement();

                    $em = $this->getDoctrine()->getManager();
                    $user = $em->getRepository('UserExamBundle:UserManagement')->find($id);

                    if (!$user) {
                        throw $this->createNotFoundException(
                            'No user found for id '.$idtoupdate
                        );
                    }
                    $user->setPassword(sha1($newpassdata));
                    $user->setConpass(sha1($conpassdata));
                    $em->flush();

                    return $this->redirect('profile');

        }

    }

}