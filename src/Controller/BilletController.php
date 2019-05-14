<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                    ->add('prenom', TextType::class, [
                        'label' => 'Prénom'
                        ])
                    ->add('nom', TextType::class, [
                        'label' => 'Nom'])
                    ->add('email', EmailType::class, [
                        'attr' => ['aria-describedby' => 'basic-addon1']])
                    ->add('DateTime', DateType::class, array(
                        'label' => 'Date de visite',
                        'widget' => 'single_text',
                        'attr' => ['class' => 'datepicker'],
                        'required' => true
                        )
                    )
                    ->add('nombre', ChoiceType::class,[
                        'label' => 'Choix du nombre de billets',
                        'placeholder' => 'Choisir...',
                        'choices' => [
                            '1' => 1,
                            '2' => 2,
                            '3' => 3,
                            '4' => 4,
                            '5' => 5 ] ])
                    ->add('type', ChoiceType::class,[
                        'label' => 'Quel type de billet ?',
                        'choices' => [
                            'Journée' => 1,
                            'Demi-Journée' => 0 ] ])
                    
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
<<<<<<< HEAD

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
=======
}
>>>>>>> parent of 03fadf8... CGV et CGU sur le home
