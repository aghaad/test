<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Services;

/**
 * Description of Stripe
 *
 * 
 */
class StripePayment {
    
    public function StripePayment($prixTTC, $token) {

        try {
            \Stripe\Stripe::setApiKey("pk_test_OETqWICpPFb6Rwv8C3GXF7AH00JJanRIcx");


            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:

           return \Stripe\Charge::create([
                'amount' => $prixTTC,
                'currency' => 'eur',
                'description' => 'Paiement final',
                'source' => $token,
                'receipt_email' => 'le.musee.du.louvre.75@gmail.com',
            ]);
        } catch (\Exception $e) {
            
            return false;
          
        }
    }
}
