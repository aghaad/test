<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Twig\Environment;


class SendMail3 {
    /**
     *
     * @var type Swift_Mailer
     */
  // private $mailer;
    
    /**
     *
     * @var type Environment
     */
   // private $renderer;

  public function __construct(Environment $renderer) {

        $this->renderer = $renderer;
    }

    public function MailConfirmation($reservation,$billets)  {
        
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'email-smtp.eu-west-1.amazonaws.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'Your username';                 // SMTP username
            $mail->Password = 'Your Password';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('am.aghaad@gmail.com', 'reservations');
                $mail->addAddress('aghaad@live.fr', 'Mme AMRANI Aghaad');     // Add a recipient
                $mail->addAddress('aghaad@live.fr');               // Name is optional
                $mail->addReplyTo('am.aghaad@gmail.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('https://www.aghaad.fr/images/Logo_louvre.png');    // Optional name

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Confirmation de votre réservation';
                $mail->Body    = $this->renderer->render(
                        // templates/emails/confirmation.html.twig
                        'louvre/EmailsConfirmation.html.twig', [
                    'recap' => $reservation,
                    'billets' => $billets,],
                'text/html'
        );
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }

        
}
}
