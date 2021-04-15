<?php

session_start();

if (!isset($_SESSION['user_data'])) {
    header('location: index.php');
}

require('database/ChatUser.php');

$user_object = new ChatUser;

$user_id = '';

foreach ($_SESSION['user_data'] as $key => $value) {
    $user_id = $value['id'];
}

$user_object->setUserId($user_id);

$user_data = $user_object->get_user_data_by_id();

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
                                    <li>
                                        <a href="#">
                                            <div class="media">
                                                <div class="chat-user-img online align-self-center mr-3">
                                                    <img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-xs" alt="">
                                                    <span class="user-status"></span>
                                                </div>
                                                <div class="media-body overflow-hidden">
                                                    <h5 class="text-truncate font-size-15 mb-1">Doris Brown</h5>
                                                    <p class="chat-user-message text-truncate mb-0">Nice to meet you</p>
                                                </div>
                                                <div class="font-size-11">10:12 AM</div>

                                            </div>
                                        </a>
                                    </li>
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

        <!-- Start User chat -->
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
                                        <img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-xs" alt="">
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h5 class="font-size-16 mb-0 text-truncate"><a href="#" class="text-reset user-profile-show">Doris Brown</a> <i class="ri-record-circle-fill font-size-10 text-success d-inline-block ml-1"></i>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 col-4">
                                <ul class="list-inline user-chat-nav text-right mb-0">

                                    <li class="list-inline-item">
                                        <div class="dropdown">
                                            <button class="btn nav-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-search-line"></i>
                                            </button>
                                            <div class="dropdown-menu p-0 dropdown-menu-right dropdown-menu-md">
                                                <div class="search-box p-2">
                                                    <input type="text" class="form-control bg-light border-0" placeholder="Search..">
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-inline-item d-none d-lg-inline-block">
                                        <button type="button" class="btn nav-btn user-profile-show">
                                            <i class="ri-user-2-line"></i>
                                        </button>
                                    </li>

                                    <li class="list-inline-item">
                                        <div class="dropdown">
                                            <button class="btn nav-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-fill"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item d-block d-lg-none user-profile-show" href="#">View profile <i class="ri-user-2-line float-right text-muted"></i></a>
                                                <a class="dropdown-item" href="#">Archive <i class="ri-archive-line float-right text-muted"></i></a>
                                                <a class="dropdown-item" href="#">Muted <i class="ri-volume-mute-line float-right text-muted"></i></a>
                                                <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-right text-muted"></i></a>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end chat user head -->

                    <!-- start chat conversation -->
                    <div class="chat-conversation p-3 p-lg-4" data-simplebar="init">
                        <ul class="list-unstyled mb-0" id="messages_area">
                            <?php
                                foreach($chat_data as $key => $chat)
                                {
                                    
                                    if(isset($_SESSION['user_data'][$chat['userid']]))
                                    {
                                        $from = 'ME';
                                        echo "<li><div class='conversation-list'><div class='chat-avatar'><img src=".$user_data['user_profile']." alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>".$chat['msg']."</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>".$chat['created_on']."</span></p></div></div><div class='conversation-name'>".$from."</div></div></div></li>";
                                    }
                                    else
                                    {
                                        $from_object = new ChatUser;
                                        $from_object->setUserId($chat['userid']);
                                        $from_data = $from_object->get_user_data_by_id();
                                        echo "<li class='right'><div class='conversation-list'><div class='chat-avatar'><img src=".$from_data['user_profile']." alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>".$chat['msg']."</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>".$chat['created_on']."</span></p></div></div><div class='conversation-name'>".$from_data['user_name']."</div></div></div></li>";
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

                <!-- start User profile detail sidebar -->
                <div class="user-profile-sidebar">
                    <div class="px-3 px-lg-4 pt-3 pt-lg-4">
                        <div class="user-chat-nav text-right">
                            <button type="button" class="btn nav-btn" id="user-profile-hide">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    </div>

                    <div class="text-center p-4 border-bottom">
                        <div class="mb-4">
                            <img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-lg img-thumbnail" alt="">
                        </div>

                        <h5 class="font-size-16 mb-1 text-truncate">Doris Brown</h5>
                        <p class="text-muted text-truncate mb-1"><i class="ri-record-circle-fill font-size-10 text-success mr-1"></i> Active</p>
                    </div>
                    <!-- End profile user -->

                    <!-- Start user-profile-desc -->
                    <div class="p-4 user-profile-desc" data-simplebar>

                        <div id="profile-user-accordion" class="custom-accordion">
                            <div class="card shadow-none border mb-2">
                                <a href="#collapseOne" class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="font-size-14 m-0">
                                            <i class="ri-user-2-line mr-2 align-middle d-inline-block"></i> About
                                            <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                                        </h5>
                                    </div>
                                </a>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#profile-user-accordion">
                                    <div class="card-body">

                                        <div>
                                            <p class="text-muted mb-1">Name</p>
                                            <h5 class="font-size-14">Doris Brown</h5>
                                        </div>

                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Email</p>
                                            <h5 class="font-size-14">doris.brown@gmail.com</h5>
                                        </div>

                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Date Of Birth</p>
                                            <h5 class="font-size-14">12-Aug-1987</h5>
                                        </div>

                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Location</p>
                                            <h5 class="font-size-14 mb-0">California, USA</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End About card -->

                            <div class="card mb-1 shadow-none border">
                                <a href="#collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="font-size-14 m-0">
                                            <i class="ri-attachment-line mr-2 align-middle d-inline-block"></i> Attached
                                            Files
                                            <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                                        </h5>
                                    </div>
                                </a>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#profile-user-accordion">
                                    <div class="card-body">
                                        <div class="card p-2 border mb-2">
                                            <div class="media align-items-center">
                                                <div class="avatar-sm mr-3">
                                                    <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                                        <i class="ri-file-text-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-left">
                                                        <h5 class="font-size-14 mb-1">admin_v1.0.zip</h5>
                                                        <p class="text-muted font-size-13 mb-0">12.5 MB</p>
                                                    </div>
                                                </div>

                                                <div class="ml-4">
                                                    <ul class="list-inline mb-0 font-size-18">
                                                        <li class="list-inline-item">
                                                            <a href="#" class="text-muted px-1">
                                                                <i class="ri-download-2-line"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item dropdown">
                                                            <a class="dropdown-toggle text-muted px-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="profile.php">Edit</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Delete</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->

                                        <div class="card p-2 border mb-2">
                                            <div class="media align-items-center">
                                                <div class="avatar-sm mr-3">
                                                    <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                                        <i class="ri-image-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-left">
                                                        <h5 class="font-size-14 mb-1">Image-1.jpg</h5>
                                                        <p class="text-muted font-size-13 mb-0">4.2 MB</p>
                                                    </div>
                                                </div>

                                                <div class="ml-4">
                                                    <ul class="list-inline mb-0 font-size-18">
                                                        <li class="list-inline-item">
                                                            <a href="#" class="text-muted px-1">
                                                                <i class="ri-download-2-line"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item dropdown">
                                                            <a class="dropdown-toggle text-muted px-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="profile.php">Edit</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Delete</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->

                                        <div class="card p-2 border mb-2">
                                            <div class="media align-items-center">
                                                <div class="avatar-sm mr-3">
                                                    <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                                        <i class="ri-image-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-left">
                                                        <h5 class="font-size-14 mb-1">Image-2.jpg</h5>
                                                        <p class="text-muted font-size-13 mb-0">3.1 MB</p>
                                                    </div>
                                                </div>

                                                <div class="ml-4">
                                                    <ul class="list-inline mb-0 font-size-18">
                                                        <li class="list-inline-item">
                                                            <a href="#" class="text-muted px-1">
                                                                <i class="ri-download-2-line"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item dropdown">
                                                            <a class="dropdown-toggle text-muted px-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Delete</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->

                                        <div class="card p-2 border mb-2">
                                            <div class="media align-items-center">
                                                <div class="avatar-sm mr-3">
                                                    <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                                        <i class="ri-file-text-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-left">
                                                        <h5 class="font-size-14 mb-1">Landing-A.zip</h5>
                                                        <p class="text-muted font-size-13 mb-0">6.7 MB</p>
                                                    </div>
                                                </div>

                                                <div class="ml-4">
                                                    <ul class="list-inline mb-0 font-size-18">
                                                        <li class="list-inline-item">
                                                            <a href="#" class="text-muted px-1">
                                                                <i class="ri-download-2-line"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item dropdown">
                                                            <a class="dropdown-toggle text-muted px-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="profile.php">Edit</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Delete</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->

                                    </div>

                                </div>
                            </div>
                            <!-- End Attached Files card -->
                        </div>
                        <!-- end profile-user-accordion -->
                    </div>
                    <!-- end user-profile-desc -->
                </div>
                <!-- end User profile detail sidebar -->
            </div>
        </div>
        <!-- End User chat -->
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

        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);

            var data = JSON.parse(e.data);

            if(data.from == 'Me')
            {
                var html_data = "<li><div class='conversation-list'><div class='chat-avatar'><img src="+data.user_profile+" alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>"+data.msg+"</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>"+data.msgTime+"</span></p></div></div><div class='conversation-name'>"+data.from+"</div></div></div></li>";
            }
            else
            {
                var html_data = "<li class='right'><div class='conversation-list'><div class='chat-avatar'><img src="+data.user_profile+" alt=''></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>"+data.msg+"</p><p class='chat-time mb-0'><i class='ri-time-line align-middle'></i><span class='align-middle'>"+data.msgTime+"</span></p></div></div><div class='conversation-name'>"+data.from+"</div></div></div></li>";
            }
            $('#messages_area').append(html_data);
            $('#chat_message').val('');

        }

        $('#chat_form').parsley();
        $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

        $('#chat_form').on('submit', function(event){

            event.preventDefault();

            if($('#chat_form').parsley().isValid()){
                var user_id = $('#login_user_id').val();
                var message = $('#chat_message').val();

                
                var data ={
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
    });
</script>

<!-- Mirrored from themesbrand.com/chatvia/layouts/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Aug 2020 18:59:42 GMT -->

</html>