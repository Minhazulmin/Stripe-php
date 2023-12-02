<?php
require_once 'config.php';
?>
<html>

<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <title>MIN IT : Payment Gateway</title>

    <link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="row" style="margin-top:10%">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <div class="card shadow ">
                    <div class="text-uppercase text-center header-top shadow">
                        <h5 class=" ">Pay with Cards</h5>
                    </div>
                    <!-- Display status message -->

                    <div id="stripe-payment-message" class="p-4 hidden mt-2 ms-4 me-4"></div>

                    <form id="stripe-payment-form" class="hidden p-4">
                        <input type='hidden' id='publishable_key' value='<?php echo STRIPE_PUBLISHABLE_KEY; ?>'>
                        <div class="form-group mt-3">
                            <label><strong>Full Name</strong></label>
                            <input type="text" id="fullname" class="form-control" maxlength="50" required autofocus>
                        </div>
                        <div class="form-group">
                            <label><strong>E-Mail</strong></label>
                            <input type="email" id="email" class="form-control" maxlength="50" required>
                        </div>

                        <div id="stripe-payment-element">
                            <!--Stripe.js will inject the Payment Element here to get card details-->
                        </div>

                        <button id="submit-button" class="pay">
                            <div class="spinner hidden" id="spinner"></div>
                            <span id="submit-text">Pay Now</span>
                        </button>
                    </form>

                    <!-- Display the payment processing -->
                    <div id="payment_processing" class="hidden ">
                        <div class="text-center">
                            <span class="loader"></span> Please wait! Your payment is processing...
                        </div>
                    </div>

                    <!-- Display the payment reinitiate button -->
                    <div id="payment-reinitiate" class="hidden p-4">
                        <button class="reinitiate_payment " onclick="reinitiateStripe()">
                            <span> Reinitiate Payment</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

            </div>
        </div>

    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="js/stripe-checkout.js" defer></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>