<?php
/*
@Author:Minhazul Min
@Website: https://minhazulmin.github.io/
 */

session_start();

//Stripe Credentials Configuration
define( "STRIPE_SECRET_API_KEY", "PUT STRIPE SECRET API KEY" );
define( "STRIPE_PUBLISHABLE_KEY", "PUT STRIPE PUBLISHABLE API KEY" );

//Sample Product Details
define( 'CURRENCY', 'USD' );
define( 'AMOUNT', '100' );
define( 'DESCRIPTION', '' );

// Database Credentials Configuration
define( 'DB_HOST', 'localhost' );
define( 'DB_NAME', 'Your Database Name' );
define( 'DB_USERNAME', 'Your Database Username' );
define( 'DB_PASSWORD', 'Your Database Password' );
?>