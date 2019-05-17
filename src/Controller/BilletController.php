<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entiy\ChoixBillet;
use DateTime;
use App\Entity\Ticket;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Service\ServiceMailer;
use App\Service\ServiceStripe;
use App\Service\ServiceBooking;
use App\Repository\TicketRepository;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Validator\ValidatorInterface;




class BilletController extends AbstractController
{
    /**
     * @Route("/billet", name="billet")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(ChoixBillet::class);
        $billets = $repo->findAll();

        return $this->render('billet/index.html.twig', [
            'controller_name' => 'BilletController',
            'billets' => $billets
        ]);
    }


    /**
     * @Route("/", name="home")
     */
    public function home() {

        return $this->render('billet/home.html.twig',['title' => "La Billetterie du Louvre"]);
    }

    /**
     * @Route("/booking", name="booking")
     */
    public function booking(Request $request, ServiceBooking $serviceBooking, EntityManagerInterface $entitymanager)
    {
        $booking = new Booking(); 
        $ticket = new Ticket(); 

        $booking->addTicket($ticket);
 
        $form = $this->createForm(BookingType::class, $booking);
        
        $form->handleRequest($request);

        if($form->isSubmitted($booking) && $form->isValid($booking)) 
        {   
            $date = $booking->getVisitdate();            
            $r = $entitymanager->getRepository(Booking::class)->countByDay($date);
            
            if($r > 999) {
                $this->addFlash(
                    'danger',
                    $message = "Plus de 1000 tickets ont deja été réservés pour ce jour. Merci de choisir une autre date de visite"
                    );        
                return $this->render('billet/booking.html.twig', array('formBooking' => $form->createView()));    
            }

            $serviceBooking->create($booking);

            return $this->redirectToRoute('payment');
        }

        return $this->render('billet/booking.html.twig', array('formBooking' => $form->createView()));    
    } 






}
