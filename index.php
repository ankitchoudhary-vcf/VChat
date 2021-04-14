<?php

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - VAT</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=a0979a25f35731ac26dac1c170def768">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css?h=9db842b3dc3336737559eb4abc0f1b3d">

    <link rel="shortcut icon" href="assets/images/favicon.ico">

</head>

<body class="bg-gradient-primary">
    <div class="container">
    <?php
    
    if(isset($_SESSION['success_message']))
    {
        echo '
        <div class="alert alert-success">
        '.$_SESSION["success_message"].'
        </div>
        ';

        unset($_SESSION['success_message']);
    }

    ?>
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;./assets/images/image2.png&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                                    </div>

                                    <form class="user" method="post">
                                        <div class="form-group"><input class="form-control form-control-user" type="text" placeholder="Enter Username" name="username"></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" placeholder="Password" name="password"></div>
                                        <div class="form-group">
                                            <!-- <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                            </div> -->
                                        </div><input class="btn btn-primary btn-block text-white btn-user" type="submit" name="login" value="Login">
                                        <hr>
                                    </form>

                                    <div class="text-center"><a class="small" href="register.php">Create an Account!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
</body>

</html>