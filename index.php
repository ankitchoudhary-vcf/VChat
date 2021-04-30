<?php

session_start();

$error = '';

if(isset($_SESSION['user_data']))
{
    header('location: chatroom.php');
}

if(isset($_POST['login']))
{
    require_once('database/ChatUser.php');
    $user_object = new ChatUser;
    $user_object->setUserEmail($_POST['user_email']);
    $user_data = $user_object->get_user_data_by_email();

    if(is_array($user_data) && count($user_data) > 0)
    {
        if($user_data['user_status'] == 'Enable')
        {
            if($user_data['user_password'] == $_POST['user_password'])
            {
                $user_object->setUserId($user_data['user_id']);
                $user_object->setUserLoginStatus('Login');

                $user_token = md5(uniqid());
                $user_object->setUserToken($user_token);
                
                if($user_object->update_user_login_data())
                {
                    $_SESSION['user_data'][$user_data['user_id']] = [
                        'id' => $user_data['user_id'],
                        'name' => $user_data['user_name'],
                        'profile' => $user_data['user_profile'],
                        'token' => $user_token
                    ];
                    header('location: chatroom.php');
                }
            }
            else
            {
                $error = 'Wrong Password';
            }
        }
        else
        {
            $error = 'Please Verify YOur Email Address';
        }
    }
    else
    {
        $error = 'Wrong Email Address';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - VChat</title>
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

    if($error != '')
    {
        echo '
        <div class="alert alert-danger">
        '.$error.'
        </div>
        ';
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

                                    <form class="user" method="post" id = "login_form">
                                        <div class="form-group"><input class="form-control form-control-user" type="email" placeholder="Enter Email" name="user_email" id="user_email" require data-parsley-type="email" ></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" placeholder="Password" name="user_password" id="user_password" require ></div>
                                        <div class="form-group">
                                            <!-- <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                            </div> -->
                                        </div><input class="btn btn-primary btn-block text-white btn-user" type="submit" name="login" id="login" value="Login">
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
    <script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
</body>

<script>
    $(document).ready(function(){
        $('#login_form').parsley();
    });
</script>

</html>