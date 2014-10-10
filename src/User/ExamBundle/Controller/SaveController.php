<?php
 // print_r($data); die(); 
namespace User\ExamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\ExamBundle\Entity\UserManagement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Session\Session; 
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
class SaveController extends Controller
{
    public function querycountidAction(){

                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery("SELECT count(u.id) FROM UserExamBundle:UserManagement u");
                $count = $query->getSingleScalarResult();
                //$count = $query->getResult(Query::HYDRATE_SINGLE_SCALAR);

                $count = $count + 1;

                return $count;
    }

    //Reset now
    public function resetNowAction(Request $request){

        $session = new Session();
        $email = $session->get('email');


        $request = Request::createFromGlobals();
            $data = $request->request->get('form');     
            $id = $data['id'];

            if($data['password']!= $data['conpass']){

                throw $this->createNotFoundException('Please confirm password');

            }else{

                $user = new UserManagement();
                $em = $this->getDoctrine()->getManager();
                $user = $em->getRepository('UserExamBundle:UserManagement')->find($id);

                    if (!$user) {
                        throw $this->createNotFoundException(
                            'No user found for id '.$id
                        );
                    }

                    $user->setPassword(sha1($data['password']));
                    $user->setConpass(sha1($data['conpass']));
                    $em->flush();



                $message = \Swift_Message::newInstance()
                ->setSubject('Your new password')
                ->setFrom('send@example.com')
                ->setTo($email)
                ->setBody(

                        '
                        Hi there ! 
                            Thank you for your time, this is now your new password '.$data['password']
                    
                )
            ;
            $this->get('mailer')->send($message);  



                return $this->redirect('login');
            }

    }


    //Request Email reset password
    public function sendEmailRequestAction(Request $request)
    {
            $request = Request::createFromGlobals();
            $data = $request->request->get('form');     
            $email = $data['email'];

             $em = $this->getDoctrine()->getManager();
                                $query = $em->createQuery("SELECT u FROM UserExamBundle:UserManagement u WHERE u.email = '$email'");
                                $result = $query->getResult();

                            foreach($result as $row){

                                $fname = $row->getFirstname();
                                     $lname = $row->getLastname();
                                            $id = $row->getId();
                            } 


            $message = \Swift_Message::newInstance()

                ->setSubject('Reset password request')
                ->setFrom('send@example.com')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        'UserExamBundle:Page:resetPassRequestMail.html.twig',
                                                                     array(
                                                                            'email' => $email,
                                                                            'fname' => $fname,
                                                                            'lname' => $lname,
                                                                            'id' => $id,
                                                                         )
                    )
                )
            ;

            $session = new Session();
            $session->set('id', $id);
            $session->set('email', $email);

            $this->get('mailer')->send($message);  

            return $this->render('UserExamBundle:Page:successrequest.html.twig', array(
                                                                            'email' => $email,
                ));  


          //return $this->render($email);
    }

    //send email
    public function sendEmail($id, $name, $email)
    {
        $message = \Swift_Message::newInstance()

            ->setSubject('Email Confirmation')
            ->setFrom('send@example.com')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    'UserExamBundle:Page:confirmemail.html.twig',
                                                                 array(
                                                                        'email' => $email,
                                                                        'name' => $name,
                                                                        'id' => $id,
                                                                     )
                )
            )
        ;

          try {

                $this->get('mailer')->send($message);  

            } catch(\Doctrine\DBAL\DBALException $e) {

                $this->get('session')->getFlashBag()->add('error', 'Email confirmation not sent.');

            }   
    }

    public function confirmemailAction(){

        if(isset($_GET['id'])){
                 $id = $_GET['id'];
                        $stat = 'active';

                try{
                        $user = new UserManagement();
                        $em = $this->getDoctrine()->getManager();
                        $user = $em->getRepository('UserExamBundle:UserManagement')->find($id);

                        if (!$user) {
                            throw $this->createNotFoundException(
                                'No user found for id '.$id
                            );
                        }
                        $user->setStatus($stat);
                        $em->flush();

                }catch(\Doctrine\DBAL\DBALException $e) {

                                    $this->get('session')->getFlashBag()->add('error', 'Somethings happen with the confirmation of account, Please try again!');

                                }

                return $this->redirect('login');
        }     
    }


    public function saveAction(Request $request)
    {
        $request = Request::createFromGlobals();
                $data = $request->request->get('form');
                
                //for email confirmation details
                $email = $data['email'];
                $name = $data['firstname']." ".$data['lastname'];

                    if($data['password'] != $data['conpass']){

                           return new Response('Please confirm password!'); 
                    }else{

                         $fpass = sha1($data['password']);
                         $stat = "inactive";

                         $user = new UserManagement();
                         $user->setEmail($data['email']);
                            $user->setFirstname($data['firstname']);
                                 $user->setLastname($data['lastname']);
                                    $user->setPassword($fpass);
                                        $user->setConpass($fpass);
                                             $user->setStatus($stat);

                            try{

                                    $lastid = $this->querycountidAction();
                                    // send data to email function
                                    $this->sendEmail($lastid, $name, $email); 

                                    $em = $this->getDoctrine()->getManager();
                                    $em->persist($user);
                                    $em->flush();

                                 }catch(\Doctrine\DBAL\DBALException $e) {

                                    $this->get('session')->getFlashBag()->add('error', 'Somethings happen that is cause not saving!');

                                }

                    return new Response('New account saved! Please confirm your email to continue using "exam site".'.$name); 

                    }  
         
    }

    public function updateAction(Request $request){

        $data = $request->request->get('form');
        $idtoupdate = $data['id'];

        try{


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


        }catch(\Doctrine\DBAL\DBALException $e) {

               $this->get('session')->getFlashBag()->add('error', 'Somethings happen that is cause not updating!');

        }
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