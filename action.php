<?php

session_start();

if(isset($_POST['action']) && $_POST['action'] == 'leave')
{
    require('database/ChatUser.php');

    $user_object = new ChatUser;

    $user_object->setUserId($_POST['user_id']);
    $user_object->setUserLoginStatus('Logout');

    if($user_object->update_user_login_data())
    {
        unset($_SESSION['user_data']);
        session_destroy();

        echo json_encode(['status'=>1]);
    }
}

?>