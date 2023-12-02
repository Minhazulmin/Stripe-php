<?php
/*
Author:Minhazul Min
Website: https://minhazulmin.github.io/
 */

// Include the DB config & class files
require_once 'config.php';
require_once 'dbclass.php';

// If transaction ID is not empty
if ( !empty( $_GET['tid'] ) ) {
    $transaction_id = $_GET['tid'];

    // Fetch the transaction details from DB using Transaction ID
    $sql = "SELECT * FROM `stripe_payment` WHERE transaction_id='$transaction_id'";
    $row = mysqli_fetch_array( $con->query( $sql ) );

    if ( !empty( $row ) ) {
        $fullname         = $row['fullname'];
        $email            = $row['email'];
        $item_description = $row['item_description'];
        $currency         = $row['currency'];
        $amount           = $row['amount'];
    }
} else {
    header( "Location: index.php" );
    exit();
}
?>
<html>


<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <title>MIN IT : Payment Gateway</title>

    <link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="messages">
        <div class="container" style="margin-top:10%">
            <div class="row">
                <div class="col-lg-6 mx-auto ">
                    <div class="card mt-5 p-5 shadow">
                        <div class="icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div class="text text-center">
                            <?php if ( !empty( $row ) ) {?>
                            <h1>Congratulations!</h1>
                            <p>Successfully Payment Conmpleted</p>

                            <p class="mt-5">You are <?php echo $fullname; ?> and you are requesting to send amount
                                <b><?php echo $amount . ' ' . $currency; ?></b>
                                to using this <b><?php echo $email; ?></b> and your <strong>Transaction ID:</strong>
                                <?php echo $transaction_id; ?>
                            </p>

                            <?php } else {?>
                            <h1>Error! Your transaction has been failed.</h1>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>