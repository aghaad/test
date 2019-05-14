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
use Symfony\Component\HttpFoundation\Session\Session;
use App\Form\TicketCollectionType;
use App\Services\MailerManager;

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

    public function billet(Request $request, OrderManager $orderManager)
    {
        $bookingSession = $orderManager->getSession('booking');
        $orderManager->bookingNotFound($bookingSession);
        $booking = $orderManager->initTickets($bookingSession);

        $form = $this->createForm(TicketCollectionType::class, $booking);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $orderManager->setPriceTickets($booking);

            $orderManager->setSession($booking);

            return $this->redirectToRoute('app_paiement');
        }

        return $this->render('billet/tickets.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/paiement", name="app_paiement")
     * @param Request $request
     * @param OrderManager $orderManager
     * @param MailerManager $mailerManager
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function paiement(Request $request, OrderManager $orderManager, MailerManager $mailerManager)
    {
        $booking = $orderManager->getSession('booking');
        $orderManager->bookingNotFound($booking);

        if($request->isMethod('POST'))
        {
            $token = $request->request->get('stripeToken');
            $status = $orderManager->payment($booking, $token);

            if($status)
            {

                $result = $orderManager->receipt($booking, $mailerManager);
                $this->get('session')->set('id', $booking->getId());
                if($result)
                {
                    return $this->redirectToRoute('app_confirmation', [
                            'id' => $booking->getId()
                    ]);
                }
            }

        }

        return $this->render('billet/checkout.html.twig', [
                'booking' => $booking
        ]);
    }


        /**
     * @Route("/confirmation/{id}", name="app_confirmation", requirements={"id"="\d+"})
     * @param OrderManager $orderManager
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function confirmation(orderManager $orderManager, $id)
    {

        $bookingId = $orderManager->confirmIdBySession($id);

        $booking = $orderManager->findBookingById($bookingId);

        return $this->render('billet/confirmation.html.twig', [
                    'booking' => $booking
        ]);
    }

}