<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Services\OrderManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
    
    /**
     * @Route("/", name="app_commande")
     * @param Request $request
     * @param OrderManager $orderManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commande(Request $request, OrderManager $orderManager)
    {

//        $this->get('session')->clear();

        $booking = $orderManager->initBooking();

        $form = $this->createForm(BookingType::class, $booking);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $orderManager->setSession($booking);

            return $this->redirectToRoute('app_billet');
        }
        return $this->render('billet/booking.html.twig', [
            'booking' => $form->createView(),
        ]);
    }


}