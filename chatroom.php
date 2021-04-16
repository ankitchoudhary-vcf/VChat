<?php

session_start();

if (!isset($_SESSION['user_data'])) {
    header('location: index.php');
}

require('database/ChatUser.php');

$user_object = new ChatUser;

$user_id = '';
$token = '';

foreach ($_SESSION['user_data'] as $key => $value) {
    $user_id = $value['id'];
    $token = $value['token'];
}

$user_object->setUserId($user_id);


$user_data = $user_object->get_user_data_by_id();

$users_data = $user_object->get_user_all_data();

$user_private_data = $user_object->get_user_all_data_with_status_count();

require('database/ChatRooms.php');

$chat_object = new ChatRooms;
$chat_data = $chat_object->get_all_chat_data();

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>VChat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- magnific-popup css -->
    <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.carousel.min.css">

    <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.theme.default.min.css">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap-dark.min.css" id="bootstrap-dark-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app-dark.min.css" id="app-dark-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="layout-wrapper d-lg-flex">

        <!-- Start left sidebar-menu -->
        <div class="side-menu flex-lg-column mr-lg-1">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="chatroom.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo.svg" alt="" height="30">
                    </span>
                </a>

                <a href="chatroom.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo.svg" alt="" height="30">
                    </span>
                </a>
            </div>
            <!-- end navbar-brand-box -->

            <!-- Start side-menu nav -->
            <div class="flex-lg-column my-auto">
                <ul class="nav nav-pills side-menu-nav justify-content-center" role="tablist">
                    <li class="nav-item" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Profile">
                        <a class="nav-link" id="pills-user-tab" data-toggle="pill" href="#pills-user" role="tab">
                            <i class="ri-user-2-line"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Chats">
                        <a class="nav-link active" id="pills-chat-tab" data-toggle="pill" href="#pills-chat" role="tab">
                            <i class="ri-message-3-line"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Settings" title="Broadcast Room">
                        <a class="nav-link chat-broadcast" href="#">
                            <i class="ri-group-line"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Settings">
                        <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#pills-setting" role="tab">
                            <i class="ri-settings-2-line"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown profile-user-dropdown d-inline-block d-lg-none">
                        <a class="nav-link dropdown-toggle" href="javascript: void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?php echo $user_data['user_profile']; ?>" alt="" class="profile-user rounded-circle">
                        </a>
                        <div class="dropdown-menu">
                            <input type="button" class=" btn btn-primary dropdown-item" id="logout" name="logout" value="Log Out"><i class="ri-logout-circle-r-line float-right text-muted"></i></input>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- end side-menu nav -->

            <div class="flex-lg-column d-none d-lg-block">
                <ul class="nav side-menu-nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" id="light-dark" data-toggle="tooltip" data-trigger="hover" data-placement="right" title="Dark / Light Mode">
                            <i class="ri-sun-line theme-mode-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item btn-group dropup profile-user-dropdown">

                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?php echo $user_data['user_profile']; ?>" alt="" class="profile-user rounded-circle">
                        </a>
                        <div class="dropdown-menu">
                            <input type="button" class=" btn btn-primary dropdown-item" id="logout1" name="logout" value="Log Out"><i class="ri-logout-circle-r-line float-right text-muted"></i></input>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Side menu user -->
        </div>
        <!-- end left sidebar-menu -->

        <!-- start chat-leftsidebar -->
        <div class="chat-leftsidebar mr-lg-1">

            <div class="tab-content">
                <!-- Start Profile tab-pane -->
                <div class="tab-pane" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
                    <!-- Start profile content -->
                    <div>
                        <div class="px-4 pt-4">
                            <div class="user-chat-nav float-right">
                                <div class="dropdown">
                                    <a href="javascript: void(0);" class="font-size-18 text-muted dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="profile.php">Edit</a>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mb-0">My Profile</h4>
                        </div>

                        <div class="text-center p-4 border-bottom">
                            <div class="mb-4">
                                <img src="<?php echo $user_data['user_profile']; ?>" class="rounded-circle avatar-lg img-thumbnail" alt="">
                            </div>
                            <input type="hidden" name="login_user_id" id="login_user_id" value="<?php echo $user_id; ?>">
                            <input type="hidden" name="is_active_chat" id="is_active_chat" value="No" />
                            <h5 class="font-size-16 mb-1 text-truncate"><?php echo $user_data['user_name']; ?></h5>
                            <p class="text-muted text-truncate mb-1"><i class="ri-record-circle-fill font-size-10 text-success mr-1 d-inline-block"></i>
                                Active</p>
                        </div>
                        <!-- End profile user -->

                        <!-- Start user-profile-desc -->
                        <div class="p-4 user-profile-desc" data-simplebar>

                            <div id="profile-user-accordion-1" class="custom-accordion">
                                <div class="card shadow-none border mb-2">
                                    <a href="#profile-user-collapseOne" class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="profile-user-collapseOne">
                                        <div class="card-header" id="profile-user-headingOne">
                                            <h5 class="font-size-14 m-0">
                                                <i class="ri-user-2-line mr-2 align-middle d-inline-block"></i> About
                                                <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                                            </h5>
                                        </div>
                                    </a>

                                    <div id="profile-user-collapseOne" class="collapse show" aria-labelledby="profile-user-headingOne" data-parent="#profile-user-accordion-1">
                                        <div class="card-body">

                                            <div>
                                                <p class="text-muted mb-1">Name</p>
                                                <h5 class="font-size-14"><?php echo $user_data['user_name']; ?></h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Email</p>
                                                <h5 class="font-size-14"><?php echo $user_data['user_email']; ?></h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Account Created On</p>
                                                <h5 class="font-size-14"><?php echo $user_data['user_created_on']; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End About card -->

                            </div>
                            <!-- end profile-user-accordion -->

                        </div>
                        <!-- end user-profile-desc -->
                    </div>
                    <!-- End profile content -->
                </div>
                <!-- End Profile tab-pane -->

                <!-- Start chats tab-pane -->
                <div class="tab-pane fade show active" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
                    <!-- Start chats content -->
                    <div>
                        <div class="px-4 pt-4">
                            <h4 class="mb-4">Chats</h4>
                            <div class="search-box chat-search-box">
                                <div class="input-group mb-3 bg-light  input-group-lg rounded-lg">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-link text-muted pr-1 text-decoration-none" type="button">
                                            <i class="ri-search-line search-icon font-size-18"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control bg-light" placeholder="Search messages or users">
                                </div>
                            </div> <!-- Search Box-->
                        </div> <!-- .p-4 -->

                        <!-- Start chat-message-list -->
                        <div class="px-2">
                            <h5 class="mb-3 px-3 font-size-16">Recent</h5>

                            <div class="chat-message-list" data-simplebar>

                                <ul class="list-unstyled chat-list chat-user-list">
                                    <?php

                                    foreach ($user_private_data as $key => $user) {
                                        if ($user['user_id'] != $user_id) {
                                            if ($user['user_login_status'] == 'Login') {
                                                $status = "online";
                                            } else {
                                                $status = "away";
                                            }
                                            if ($user['count_status'] > 0) {
                                                echo '
                                                <li class="unread">
                                                    <a href="#" class ="list-group-item list-group-action select_user" style="cursor:pointer;" data-userid=' . $user['user_id'] . ' id="' . $user['user_id'] . '"  data-user_name=' . $user['user_name'] . ' data-user_profile =' . $user['user_profile'] . ' >
                                                        <div class="media">
                                                            <div class="chat-user-img ' . $status . ' align-self-center mr-3">
                                                                <img src="' . $user['user_profile'] . '";
                                                                    class="rounded-circle avatar-xs" alt="">
                                                                <span class="user-status"></span>
                                                            </div>
                                                            <div class="media-body overflow-hidden">
                                                                <h5 class="text-truncate font-size-15 mb-1">' . $user['user_name'] . '</h5>
                                                                <span id="userLs_'.$user['user_id'].'" class="chat-user-message text-truncate mb-0"></span>
                                                            </div>
                                                            <div class="font-size-11">12 min</div>

                                                            <div class="unread-message">
                                                                <span id="userid_' . $user['user_id'] . '" class="badge badge-soft-danger badge-pill">' . $user['count_status'] . '</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                ';
                                            } else {
                                                echo '
                                                <li>
                                                    <a href="#" class ="list-group-item list-group-action select_user" style="cursor:pointer;" data-userid=' . $user['user_id'] . ' id="' . $user['user_id'] . '" data-user_name=' . $user['user_name'] . ' data-user_profile =' . $user['user_profile'] . ' >
                                                        <div class="media">
                                                            <div class="chat-user-img ' . $status . ' align-self-center mr-3">
                                                                <img src="' . $user['user_profile'] . '";
                                                                    class="rounded-circle avatar-xs" alt="">
                                                                <span class="user-status"></span>
                                                            </div>
                                                            <div class="media-body overflow-hidden">
                                                                <h5 class="text-truncate font-size-15 mb-1">' . $user['user_name'] . '</h5>
                                                                <span id="userLs_'.$user['user_id'].'" class="chat-user-message text-truncate mb-0"></span>
                                                            </div>
                                                            <div class="font-size-11">12 min</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                ';
                                            }
                                        }
                                    }

                                    ?>
                                </ul>
                            </div>

                        </div>
                        <!-- End chat-message-list -->
                    </div>
                    <!-- Start chats content -->
                </div>
                <!-- End chats tab-pane -->

                <!-- Start settings tab-pane -->
                <div class="tab-pane" id="pills-setting" role="tabpanel" aria-labelledby="pills-setting-tab">
                    <!-- Start Settings content -->

                    <div>
                        <div class="px-4 pt-4">
                            <h4 class="mb-0">Settings</h4>
                        </div>

                        <div class="text-center border-bottom p-4">
                            <div class="mb-4 profile-user">
                                <img src="<?php echo $user_data['user_profile']; ?>" class="rounded-circle avatar-lg img-thumbnail" alt="">
                                <a href="profile.php" role="button" class="btn bg-light avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <i class="ri-pencil-fill"></i>
                                </a>
                            </div>

                            <h5 class="font-size-16 mb-1 text-truncate"><?php echo $user_data['user_name']; ?></h5>
                            <div class="dropdown d-inline-block mb-1">
                                <a class="text-muted dropdown-toggle pb-1 d-block" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Available <i class="mdi mdi-chevron-down"></i>
                                </a>

                            </div>
                        </div>
                        <!-- End profile user -->

                        <!-- Start User profile description -->
                        <div class="p-4 user-profile-desc" data-simplebar>

                            <div id="profile-setting-accordion" class="custom-accordion">
                                <div class="card shadow-none border mb-2">
                                    <a href="#profile-setting-personalinfocollapse" class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="profile-setting-personalinfocollapse">
                                        <div class="card-header" id="profile-setting-personalinfoheading">
                                            <h5 class="font-size-14 m-0">
                                                Personal Info
                                                <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                                            </h5>
                                        </div>
                                    </a>

                                    <div id="profile-setting-personalinfocollapse" class="collapse show" aria-labelledby="profile-setting-personalinfoheading" data-parent="#profile-setting-accordion">
                                        <div class="card-body">

                                            <div class="float-right">
                                                <a href="profile.php" role="button" class="btn btn-light btn-sm"><i class="ri-edit-fill mr-1 align-middle"></i> Edit</a>
                                            </div>

                                            <div>
                                                <p class="text-muted mb-1">Name</p>
                                                <h5 class="font-size-14"><?php echo $user_data['user_name']; ?></h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Email</p>
                                                <h5 class="font-size-14"><?php echo $user_data['user_email']; ?></h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Account Created On</p>
                                                <h5 class="font-size-14"><?php echo $user_data['user_created_on']; ?></h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-none border mb-2">
                                    <a href="#profile-setting-helpcollapse" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="profile-setting-helpcollapse">
                                        <div class="card-header" id="profile-setting-helpheading">
                                            <h5 class="font-size-14 m-0">
                                                Help
                                                <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                                            </h5>
                                        </div>
                                    </a>
                                    <div id="profile-setting-helpcollapse" class="collapse" aria-labelledby="profile-setting-helpheading" data-parent="#profile-setting-accordion">
                                        <div class="card-body">

                                            <div>
                                                <div class="py-3">
                                                    <h5 class="font-size-13 mb-0"><a href="#" class="text-body d-block">FAQs</a></h5>
                                                </div>
                                                <div class="py-3 border-top">
                                                    <h5 class="font-size-13 mb-0"><a href="#" class="text-body d-block">Contact</a></h5>
                                                </div>
                                                <div class="py-3 border-top">
                                                    <h5 class="font-size-13 mb-0"><a href="#" class="text-body d-block">Terms & Privacy policy</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Help card -->
                            </div>
                            <!-- end profile-setting-accordion -->
                        </div>
                        <!-- End User profile description -->
                    </div>
                    <!-- Start Settings content -->
                </div>
                <!-- End settings tab-pane -->
            </div>
            <!-- end tab content -->

        </div>
        <!-- end chat-leftsidebar -->

        <!-- Start User Private Chat -->

        <div class="user-private-chat w-100" id="chat_area" style="display:none;">

        </div>
        <!--End User Private Chat-->

        <!-- Start User BroadCast chat -->
        <div class="user-chat w-100">
            <div class="d-lg-flex">

                <!-- start chat conversation section -->
                <div class="w-100">
                    <div class="p-3 p-lg-4 border-bottom">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-8">
                                <div class="media align-items-center">
                                    <div class="d-block d-lg-none mr-2">
                                        <a href="javascript: void(0);" class="user-chat-remove text-muted font-size-16 p-2"><i class="ri-arrow-left-s-line"></i></a>
                                    </div>
                                    <div class="mr-3">
                                        <img src="assets/images/small/img-2.jpg" class="rounded-circle avatar-xs" alt="">
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h5 class="font-size-16 mb-0 text-truncate"><a href="#" class="text-reset user-profile-show">Broadcast Room</a> <i class="ri-record-circle-fill font-size-10 text-success d-inline-block ml-1"></i>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end chat user head -->

                    <!-- start chat conversation -->
                    <div class="chat-conversation p-3 p-lg-4" data-simplebar="init">
                        <ul class="list-unstyled mb-0" id="messages_area">
                            <?php
                            foreach ($chat_data as $key => $chat) {

                                if (isset($_SESSION['user_data'][$chat['userid']])) {
                                    $from = 'Me';
                                    echo '<li>
                                        <div class="conversation-list">
                                            <div class="chat-avatar">
                                                <img src="' . $user_data['user_profile'] . '" alt="">
                                            </div>
                                            <div class="user-chat-content">
                                                <div class="ctext-wrap">
                                                    <div class="ctext-wrap-content">
                                                        <p class="mb-0">"' . $chat['msg'] . '"</p>
                                                        <p class="chat-time mb-0">
                                                            <i class="ri-time-line align-middle"></i>
                                                            <span class="align-middle">"' . $chat['created_on'] . '"</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            <div class="conversation-name">"' . $from . '"</div>
                                        </div>
                                        </li>';
                                } else {
                                    $from_object = new ChatUser;
                                    $from_object->setUserId($chat['userid']);
                                    $from_data = $from_object->get_user_data_by_id();
                                    echo "<li class='right'>
                                                <div class='conversation-list'>
                                                    <div class='chat-avatar'>
                                                        <img src=" . $from_data['user_profile'] . " alt=''>
                                                    </div>
                                                    <div class='user-chat-content'>
                                                        <div class='ctext-wrap'>
                                                            <div class='ctext-wrap-content'>
                                                                <p class='mb-0'>" . $chat['msg'] . "</p>
                                                                <p class='chat-time mb-0'>
                                                                    <i class='ri-time-line align-middle'></i>
                                                                    <span class='align-middle'>" . $chat['created_on'] . "</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class='conversation-name'>" . $from_data['user_name'] . "</div>
                                                    </div>
                                                </div>
                                            </li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- end chat conversation end -->

                    <!-- start chat input section -->
                    <form method="post" id="chat_form">
                        <div class="p-3 p-lg-4 border-top mb-0">
                            <div class="row no-gutters">
                                <div class="col">
                                    <div>
                                        <input type="text" id="chat_message" data-parsley-maxlength="1000" class="form-control form-control-lg bg-light border-light" placeholder="Enter Message..." require>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="chat-input-links ml-md-2">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <button type="button" class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect" data-toggle="tooltip" data-placement="top" title="Emoji">
                                                    <i class="ri-emotion-happy-line"></i>
                                                </button>
                                            </li>
                                            <li class="list-inline-item">
                                                <button type="button" class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect" data-toggle="tooltip" data-placement="top" title="Attached File">
                                                    <i class="ri-attachment-line"></i>
                                                </button>
                                            </li>
                                            <li class="list-inline-item">
                                                <button type="submit" name="send" id="send" class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light">
                                                    <i class="ri-send-plane-2-fill"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <div id="validation_errors"></div>
                            </div>
                        </div>
                    </form>
                    <!-- end chat input section -->
                </div>
                <!-- end chat conversation section -->
            </div>
        </div>
        <!-- End User Broadcast chat -->
    </div>
    <!-- end  layout wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- Magnific Popup-->
    <script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- owl.carousel js -->
    <script src="assets/libs/owl.carousel/owl.carousel.min.js"></script>

    <!-- page init -->
    <script src="assets/js/pages/index.init.js"></script>

    <script src="assets/js/app.js"></script>
    <script src="vendor-front/jquery-easing/jquery.easing.min.js"></script>

    <script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>

</body>
<script>
    $(document).ready(function() {

        var receiver_user_id = '';

        var conn_private = new WebSocket('ws://localhost:8080?token=<?php echo $token; ?>');

        conn_private.onopen = function(event) {
            console.log('Connection Established!');
        };
        conn_private.onmessage = function(event) {
            var data = JSON.parse(event.data);
            var html_data = '';
            if (data.from == 'Me') {
                html_data += "<li><div class='conversation-list'><div class='chat-avatar'><img src=" + data.user_profile + " alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>" + data.msg + "</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>" + data.msgTime + "</span></p></div></div><div class='conversation-name'>" + data.from + "</div></div></div></li>";
            } else {
                html_data += "<li class='right'><div class='conversation-list'><div class='chat-avatar'><img src=" + data.user_profile + " alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>" + data.msg + "</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>" + data.msgTime + "</span></p></div></div><div class='conversation-name'>" + data.from + "</div></div></div></li>";
            }
            if (receiver_user_id == data.userId || data.from == 'Me') {
                if ($('#is_active_chat').val() == 'Yes') {
                    $('#private_chat_area').append(html_data);
                    $('#private_chat_area').scrollTop($('#private_chat_area')[0].scrollHeight);
                    $('#private_chat_message').val('');
                }
            }


        };
        conn_private.onclose = function(event) {
            console.log('connection closed!');
        };



        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);

            var data = JSON.parse(e.data);

            if (data.from == 'Me') {
                var html_data = "<li><div class='conversation-list'><div class='chat-avatar'><img src=" + data.user_profile + " alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>" + data.msg + "</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>" + data.msgTime + "</span></p></div></div><div class='conversation-name'>" + data.from + "</div></div></div></li>";
            } else {
                var html_data = "<li class='right'><div class='conversation-list'><div class='chat-avatar'><img src=" + data.user_profile + " alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>" + data.msg + "</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>" + data.msgTime + "</span></p></div></div><div class='conversation-name'>" + data.from + "</div></div></div></li>";
            }
            $('#messages_area').append(html_data);
            $('#chat_message').val('');

        }

        $('#chat_form').parsley();
        $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

        $('#chat_form').on('submit', function(event) {

            event.preventDefault();

            if ($('#chat_form').parsley().isValid()) {
                var user_id = $('#login_user_id').val();
                var message = $('#chat_message').val();


                var data = {
                    userId: user_id,
                    msg: message
                }

                $('#chat_message').val('');
                conn.send(JSON.stringify(data));

                $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);


            }
        });

        $('#logout').click(function() {
            user_id = $('#login_user_id').val();

            $.ajax({
                url: "action.php",
                method: "POST",
                data: {
                    user_id: user_id,
                    action: 'leave'
                },
                success: function(data) {
                    var response = JSON.parse(data);

                    if (response.status == 1) {
                        location = 'index.php';
                    }
                }
            })
        });

        $('#logout1').click(function() {
            user_id = $('#login_user_id').val();

            $.ajax({
                url: "action.php",
                method: "POST",
                data: {
                    user_id: user_id,
                    action: 'leave'
                },
                success: function(data) {
                    var response = JSON.parse(data);

                    if (response.status == 1) {
                        location = 'index.php';
                    }
                }
            })
        });

        function make_chat_area(user_name, user_profile) {
            var html = "<div class='d-lg-flex'><div class='w-100'><div class='p-3 p-lg-4 border-bottom'><div class='row align-items-center'><div class='col-sm-4 col-8'><div class='media align-items-center'><div class='d-block d-lg-none mr-2'> <a href='javascript: void(0);' class='user-private-chat-remove text-muted font-size-16 p-2'><i class='ri-arrow-left-s-line'></i></a></div><div class='mr-3'> <img src=" + user_profile + " class='rounded-circle avatar-xs' alt=''></div><div class='media-body overflow-hidden'><h5 class='font-size-16 mb-0 text-truncate'><a href='#' class='text-reset user-profile-show'>" + user_name + "</a> <i class='ri-record-circle-fill font-size-10 text-success d-inline-block ml-1'></i></h5></div></div></div></div></div><div class='chat-conversation p-3 p-lg-4' data-simplebar='init'><ul class='list-unstyled mb-0' id='private_chat_area'></ul></div><form method='post' id='private_chat_form'><div class='p-3 p-lg-4 border-top mb-0'><div class='row no-gutters'><div class='col'><div> <input type='text' id='private_chat_message' data-parsley-maxlength='1000' class='form-control form-control-lg bg-light border-light' placeholder='Enter Message...' require></div></div><div class='col-auto'><div class='chat-input-links ml-md-2'><ul class='list-inline mb-0'><li class='list-inline-item'> <button type='button' class='btn btn-link text-decoration-none font-size-16 btn-lg waves-effect' data-toggle='tooltip' data-placement='top' title='Emoji'> <i class='ri-emotion-happy-line'></i> </button></li><li class='list-inline-item'> <button type='button' class='btn btn-link text-decoration-none font-size-16 btn-lg waves-effect' data-toggle='tooltip' data-placement='top' title='Attached File'> <i class='ri-attachment-line'></i> </button></li><li class='list-inline-item'> <button type='submit' name='sendmsg' id='sendmsg' class='btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light'> <i class='ri-send-plane-2-fill'></i> </button></li></ul></div></div><div id='validation_errors'></div></div></div></form></div></div>";

            $('#chat_area').html(html);
            $('#private_chat_form').parsley();

        }

        $(document).on('click', '.select_user', function() {

            conn.close();
            conn_private.close();
            conn_private = new WebSocket('ws://localhost:8080?token=<?php echo $token; ?>');
            conn_private.onopen = function(event) {
                console.log('Connection Established!');
            };
            conn_private.onmessage = function(event) {
                var data = JSON.parse(event.data);
                var html_data = '';
                if (data.from == 'Me') {
                    html_data += "<li><div class='conversation-list'><div class='chat-avatar'><img src=" + data.sender_profile + " alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>" + data.msg + "</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>" + data.msgTime + "</span></p></div></div><div class='conversation-name'>" + data.from + "</div></div></div></li>";
                } else {
                    html_data += "<li class='right'><div class='conversation-list'><div class='chat-avatar'><img src=" + data.sender_profile + " alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>" + data.msg + "</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>" + data.msgTime + "</span></p></div></div><div class='conversation-name'>" + data.from + "</div></div></div></li>";
                }
                if (receiver_user_id == data.userId || data.from == 'Me') {
                    if ($('#is_active_chat').val() == 'Yes') {
                        $('#private_chat_area').append(html_data);
                        $('#private_chat_area').scrollTop($('#private_chat_area')[0].scrollHeight);
                        $('#private_chat_message').val('');
                        $('#userLs_' + receiver_user_id).html(data.msg);
                    }
                    else
                    {
                        var count_chat = $('#userid_'+data.userId).text();

                        if(count_chat == '')
                        {
                            count_chat = 0;
                        }

                        count_chat++;

                        $('#userid_'+data.userId).html('<span class="badge badge-danger badge-pill">'+count_chat+'</span>');
                    }
                }
                
            };
            conn_private.onclose = function(event) {
                console.log('connection closed!');
            };

            receiver_user_id = $(this).data('userid');
            var from_user_id = $('#login_user_id').val();
            var receiver_user_name = $(this).data('user_name');
            var receiver_user_profile = $(this).data('user_profile');


            $('.select_user.active').removeClass('active');
            $(this).addClass('active');

            make_chat_area(receiver_user_name, receiver_user_profile);

            $('#is_active_chat').val('Yes');

            $.ajax({
                url: 'action.php',
                method: 'POST',
                data: {
                    to_user_id: receiver_user_id,
                    from_user_id: from_user_id,
                    action: 'fetch_chat'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.length > 0) {
                        var html_data = '';

                        for (var count = 0; count < data.length; count++) {
                            if (data[count].from_user_id == from_user_id) {
                                html_data += `
                                    <li>
                                        <div class="conversation-list">
                                            <div class="chat-avatar">
                                                <img src=` + data[count].from_user_profile + ` alt="">
                                            </div>
                                            <div class="user-chat-content">
                                                <div class="ctext-wrap">
                                                    <div class="ctext-wrap-content">
                                                        <p class="mb-0">` + data[count].chat_message + `</p>
                                                        <p class="chat-time mb-0">
                                                            <i class="ri-time-line align-middle"></i>
                                                            <span class="align-middle">` + data[count].timestamp + `</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            <div class="conversation-name">Me</div>
                                        </div>
                                    </li>`;
                            } else {
                                html_data += `
                                            <li class='right'>
                                                <div class='conversation-list'>
                                                    <div class='chat-avatar'>
                                                        <img src=` + data[count].from_user_profile + ` alt=''>
                                                    </div>
                                                    <div class='user-chat-content'>
                                                        <div class='ctext-wrap'>
                                                            <div class='ctext-wrap-content'>
                                                                <p class='mb-0'>` + data[count].chat_message + `</p>
                                                                <p class='chat-time mb-0'>
                                                                    <i class='ri-time-line align-middle'></i>
                                                                    <span class='align-middle'>` + data[count].timestamp + `</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class='conversation-name'>` + data[count].from_user_name + `</div>
                                                    </div>
                                                </div>
                                            </li>`; 
                            }

                            $('#userid_' + receiver_user_id).html('');
                            $('#userLs_' + receiver_user_id).html(data[count].chat_message);
                            $('#private_chat_area').html(html_data);
                            $('#private_chat_area').scrollTop($('#private_chat_area')[0].scrollHeight);
                        }
                    }

                }
            })



        });

        $(document).on('click', '.user-private-chat-remove', function() {
            $('.select_user.active').removeClass('active');
            $(".user-private-chat").removeClass("user-private-chat-show");
            $(".user-private-chat").hide();
            $(".user-chat").show();
            $('#is_active_chat').val('No');
            receiver_user_id = '';
            void(0);
        });

        $(document).on('submit', '#private_chat_form', function(event) {

            event.preventDefault();

            if ($('#private_chat_form').parsley().isValid()) {
                var user_id = $('#login_user_id').val();
                var message = $('#private_chat_message').val();
                var data = {
                    userId: user_id,
                    msg: message,
                    receiver_userId: receiver_user_id,
                    command: 'Private'
                };

                $('#private_chat_message').val('');
                conn_private.send(JSON.stringify(data));

            }
        });

        $(document).on('click', '.chat-broadcast', function(e) {
            conn_private.close();
            conn.close();
            conn = new WebSocket('ws://localhost:8080');
            conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);

            var data = JSON.parse(e.data);

            if (data.from == 'Me') {
                var html_data = "<li><div class='conversation-list'><div class='chat-avatar'><img src=" + data.user_profile + " alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>" + data.msg + "</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>" + data.msgTime + "</span></p></div></div><div class='conversation-name'>" + data.from + "</div></div></div></li>";
            } else {
                var html_data = "<li class='right'><div class='conversation-list'><div class='chat-avatar'><img src=" + data.user_profile + " alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>" + data.msg + "</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>" + data.msgTime + "</span></p></div></div><div class='conversation-name'>" + data.from + "</div></div></div></li>";
            }
            $('#messages_area').append(html_data);
            $('#chat_message').val('');

        }
        });
    });
</script>

<!-- Mirrored from themesbrand.com/chatvia/layouts/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Aug 2020 18:59:42 GMT -->

</html>