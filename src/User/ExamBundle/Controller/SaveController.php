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

    public function updateAction(Request $request)
    {

        $data = $request->request->get('form');
        $user = new UserManagement();

        $response = $data['id'];


        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserExamBundle:UserManagement')->find($response);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$response
            );
        }
        $user->setEmail($data['email']);
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $fpass = sha1($data['password']);
        $user->setPassword($fpass);
        $em->flush();

        return new Response("<script>
                                    alert('Updating success!');
                                </script>");

      //  return $this->redirect($this->generateUrl('user_exam_profile'));

    }

}