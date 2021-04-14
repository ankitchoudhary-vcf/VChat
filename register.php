<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


$error = '';
$success_message = '';

if(isset($_POST["register"]))
{
    session_start();
    if(isset($_SESSION['user_data']))
    {
        header('location:chatroom.php');
    }

    require_once('database/ChatUser.php');

    $user_object = new ChatUser;
    $user_object->setUserName($_POST['user_name']);
    $user_object->setUserEmail($_POST['user_email']);
    $user_object->setUSerPassword($_POST['user_password']);
    $user_object->setUserProfile($user_object->make_avatar(strtoupper($_POST['user_name'][0])));
    $user_object->setUserStatus('Disable');
    $user_object->setUserLoginStatus('Logout');
    $user_object->setUserCreateOn(date('Y-m-d H:i:s'));
    $user_object->setUserVerificationCode(md5(uniqid()));
    $user_data = $user_object->get_user_data_by_email();

    if(is_array($user_data) && count($user_data) > 0)
    {
        $error = 'This Email Already Register';
    }
    else
    {
        if($user_object->save_data())
        {
            $mail = new PHPMailer(true);
            $mail->IsSMTP(); 
            $mail->isHTML(true);
            $mail->SMTPDebug  = 0;                     
            $mail->SMTPAuth   = true;                  
            $mail->SMTPSecure = "ssl";                 
            $mail->Host       = "smtp.gmail.com";      
            $mail->Port        = '465'; 
            $mail->Username = 'aicephotoc@gmail.com';
            $mail->Password = 'aicephotoc123';
            $mail->setFrom('aicephotoc@gmail.com', 'VChat');
            $mail->addAddress($user_object->getUserEmail());
            $mail->Subject = 'Registration Verification for Chat Application Demo';
            $mail->Body = '
            <p>Thank you for registering for Chat Application Demo.</p>
                <p>This is a verification email, please click on the link to verify your email address.</p>
                <p><a href="http://localhost/VChat/verify.php?code='.$user_object->getUserVerificationCode().'">Click to Verify</a></p>
                <p>Thank you....</p>
            ';
            $mail->send();

            $success_message = 'Verification Email sent to '.$user_object->getUserEmail().', so before login first verify your account';
        }
        else{
            $error  ='Something went wrong try again';
        }
    }
}

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - VChat</title>
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
    if($error != '')
    {
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        '.$error.'
        <button type ="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        ';
    }

    if($success_message !='')
    {
        echo '
        <div class="alert alert-success">
        '.$success_message.'
        </div>
        ';
    }
    ?>
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/images/image3.png&quot;);"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create an Account!</h4>
                            </div>
                            <form class="user" method="post" id="register_form">
                                <div class="form-group row">
                                    <div class="col-sm-6"><input required class="form-control form-control-user" type="text" id="user_name" placeholder="Enter Name" name="user_name" 
                                    data-parsley-type = "/^[a-zA-Z\s]+$/"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6"><input required class="form-control form-control-user" type="email" id="user_email" placeholder="Enter Email" name="user_email" 
                                    data-parsley-type ="email"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><input required class="form-control form-control-user" type="password" id="user_password" placeholder="Enter password" name="user_password" data-parsley-type = "/^[a-zA-Z\s]+$/" data-parsley-minlength="6" data-parsley-maxlength="12"></div>
                                </div><input class="btn btn-primary btn-block text-white btn-user" type="submit" value="Register" name="register">
                                <hr>
                            </form>

                            <div class="text-center"><a class="small" href="login.php">Already have an account? Login!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        $('#register_form').parsley();
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
</body>

</html>