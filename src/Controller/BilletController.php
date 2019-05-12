<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Booking;
use App\Repository\BookingRepository;


class BilletController extends AbstractController
{
    /**
     * @Route("/billet", name="billet")
     */
    public function index()
    {
        return $this->render('billet/index.html.twig', [
            'controller_name' => 'BilletController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('billet/home.html.twig');
    }

     /**
     * @Route("/", name="home")
     */
    public function Booking(Request $request, ObjectManager $manager){
        $Booking=new Booking();

        $form=$this->createFormBuilder($Booking)
                    ->add('prenom')
                    ->add('nom')
                    ->add('email')
                    ->add('DateTime')
                    ->add('nombre')
                    ->add('type')
                    ->add('dateDeNaissance')
                    ->add('save',submitType::class,[
                        'label'=> 'Enregistrer
                    '])
                    ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($Booking);
            $manager->flush();
/**
 *return $this->render ('billet/.............à la nouvelle page,['id' => $Booking->getId ()]);
 */

        }
             
        return $this->render('billet/home.html.twig',[
            'formBillet' => $form ->createView()
        ]);
    }

 /**
     * @Route("/cgv", name="cgv")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cgv(){
        return $this->render('billet/cgv.html.twig');
    }

    /**
     * @Route("/cgu", name="cgu")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cgu(){
        return $this->render('billet/cgu.html.twig');
    }   
}
