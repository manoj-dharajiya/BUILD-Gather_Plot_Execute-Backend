<?php

require_once dirname(__FILE__).'/Stripe/vendor/autoload.php';


class Stripe {

    public function excute_payment($secret_key,$token,$amount,$description) {
        
        try {

            $stripe = new \Stripe\StripeClient($secret_key);

            $customer = $stripe->customers->create(['email'=>$token->email,'source'=>$token->id]);
            $amount = $amount * 100;

            $output = $stripe->charges->create([
                'customer'=> $customer->id,
                'receipt_email'=> $token->email,
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $customer->default_source,
                'description' => $description,
            ]);        
         
        } catch(Exception $e) {
            $output = array(
                'type' => 'error',
                'message' => "Something went wrong! Please try again.",
                'dev_message' => $e->getMessage(),
            );
        }
                
        return $output;
    }
    
}