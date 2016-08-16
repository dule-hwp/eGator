<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo IMG_STATIC_FOLDER_URL; ?>eGator_Flipped.ico">

    <title>eGator</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo URL; ?>css/bootstrap.css" rel="stylesheet">
    <!-- My custom CSS -->
    <link href="<?php echo URL; ?>css/_mystyles.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo URL; ?>css/dashboard.css" rel="stylesheet">
    <!-- Login modal window style -->
    <link href="<?php echo URL; ?>css/login_modal_style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/alertify.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/alertify_default_theme.css" rel="stylesheet">
</head>
<body>
<?php require APP . 'libs/analyticstracking.php'; ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid nav-warning">SFSU/FAU/Fulda Software Engineering Project, Summer 2016.  For Demonstration Only</div>

    <div class="container-fluid header-style">
        <?php
        session_start();
        //        print_r($_SESSION);
        ?>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo URL; ?>items/home" id="home">
                <img class="img-rounded md-7 hero-image"
                     src="<?php echo IMG_STATIC_FOLDER_URL . "eGator_Flipped.png"; ?>" width="60"
                     height="60">
            </a>

        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a <?php if (!isset($_SESSION["user"])) { ?>
                            onclick="callLogin()" href="#"
                        <?php } else { ?>
                            href="<?php echo URL; ?>items/addItemPage"
                        <?php } ?>
                        >
                            <i class="glyphicon glyphicon-import"></i> Sell Item
                        </a>
                    </li>
                    <li class="">
                        <a <?php if (!isset($_SESSION["user"])) { ?>
                            onclick="callLogin()" href="#"
                        <?php } else { ?>
                            href="<?php echo URL; ?>wishlist"
                        <?php } ?>
                        >
                            <i class="glyphicon glyphicon-bookmark"></i> Wish List
                        </a>
                    </li>
<!--                --><?php //} ?>
                <li id="login-btn-container">
                    <p class="text-center"><a id="login-btn" href="#"
                                              class="btn btn-primary <?php echo isset($_SESSION['user']) ? "hide" : ""; ?>"
                                              role="button" data-toggle="modal"
                                              data-target="#login-modal">
                            <i class="glyphicon glyphicon-log-out"></i>
                            Login
                        </a>
                    </p>
                </li>
                <?php require APP . 'view/header/account_manage.php'; ?>
                <!-- END # BOOTSNIP INFO -->
            </ul>

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input id="main-search" type="text" class="form-control input-group"
                               placeholder="Search for..."
                               value="<?php
                               if (isset($filter_data->searchTerm))
                                   print_r($filter_data->searchTerm);
//                               print_r($_POST);
                               ?>">
                        <div class="input-group-btn">
                            <button class="btn btn-default" id="search" type="button"
                                    onclick="filterItems()"
                                    value="">
                                Go!
                            </button>
                        </div>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->

        </div>
    </div>
</nav>

<?php require APP . 'view/header/login.php'; ?>

