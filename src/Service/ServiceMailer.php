<?php

namespace App\Service;

use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;

class ServiceMailer {
    // le service ne se declenche que si le payement a été a son terme
    // il permet d'envoyer un email à la personne qui a passer commande
    private $mailer;
    private $templating;

    public function __construct(\Swift_Mailer $mailer, \Twig\Environment $templating)
    {
        $this->mailer       = $mailer;
        $this->templating   = $templating;
    }

    public function userConfirmation($email, $number, $date, $price, $repoticket, $id) : bool
   {
        $message = (new \Swift_Message())
        ->setSubject('Votre paiement pour le musée du Louvre')
        ->setFrom('aghaad@live.fr')
        ->setTo($email)
        ->setBody(
            $this->templating->render(
                'billet/registrations.html.twig', [
                        'date' => $date, 
                        'price' => $price, 
                        'number' => $number, 
                        'tickets' => $repoticket->findBy(['id' => $id])
                        ]
                ),
            'text/html'
        );
        return $this->mailer->send($message);
    }
}