<?php
/*
Author:Minhazul Min
Website: https://minhazulmin.github.io/
 */

require_once 'stripe_header.php';
// Include the database connection file
require_once 'dbclass.php';

$payment     = !empty( $jsonObj->payment_intent ) ? $jsonObj->payment_intent : '';
$customer_id = !empty( $jsonObj->customer_id ) ? $jsonObj->customer_id : '';

// Retrieve customer information from stripe
try {
    $customerData = \Stripe\Customer::retrieve( $customer_id );
} catch ( Exception $e ) {
    $error = $e->getMessage();
}

if ( empty( $error ) ) {
    // If transaction was successful
    if ( !empty( $payment ) && $payment->status == 'succeeded' ) {
        // Retrieve transaction details
        $transaction_id   = $payment->id;
        $amount           = ( $payment->amount / 100 );
        $currency         = $payment->currency;
        $item_description = $payment->description;
        $payment_status   = $payment->status;

        $fulname = $email = '';
        if ( !empty( $customerData ) ) {
            if ( !empty( $customerData->name ) ) {
                $fullname = $customerData->name;
            }
            if ( !empty( $customerData->email ) ) {
                $email = $customerData->email;
            }
        }

        $date = date( 'y-m-d' );
        mysqli_query( $con, "INSERT INTO `stripe_payment`( `fullname`, `email`, `item_description`, `currency`, `amount`, `transaction_id`, `payment_status`, `created_at`)VALUES ('$fullname','$email ',' $item_description','$currency','$amount','$transaction_id','$payment_status','$date')" );

        $output = [
            'transaction_id' => $transaction_id,
        ];
        echo json_encode( $output );
    } else {
        http_response_code( 500 );
        echo json_encode( ['error' => 'Transaction has been failed!'] );
    }
} else {
    http_response_code( 500 );
    echo json_encode( ['error' => $error] );
}
?>