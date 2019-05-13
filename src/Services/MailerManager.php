<?php

namespace App\Services;

use App\Entity\Booking;

class MailerManager {

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $templating;

    /**
     * @Const Mail Musée du Louvre
     */
    private const mail = 'no-reply@museedulouvre.com';

    /**
     * MailerManager constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $templating
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * Send receipt booking confirmation
     *
     * @param Booking $booking
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function receiptSend(Booking $booking)
    {
        $subject = 'Musée du Louvre - Confirmation';
        $from = MailerManager::mail;
        $to = $booking->getEmail();
        $body = $this->templating->render('mails/receipt.html.twig', ['booking' => $booking]);
        $this->send($subject, $from, $to, $body);
    }

    /**
     * Send Contact from Contact Form
     *
     * @param array $data
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function contactSend(array $data)
    {
        $subject = 'Musée du Louvre - Contact';
        $from = $data['email'];
        $to = MailerManager::mail;
        $body = $this->templating->render('mails/contact.html.twig', ['data' => $data]);
        $this->send($subject, $from, $to, $body);
    }

    /**
     * Function Send Mail
     * @param string $subject
     * @param string $from
     * @param string $to
     * @param string $body
     */
    private function send(string $subject, string $from, string $to, string $body)
    {
        /** @var \Swift_Mime_SimpleMessage $mail */

        $mail = $this->mailer->createMessage();

        $mail->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body)
            ->setContentType('text/html');

        $this->mailer->send($mail);
    }
}