<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= isset($title) ? $title : "Corporate Filter "; ?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">

	
    <!-- Bootstrap -->
	<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    
    <!-- FontAwesome -->
	<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
    
    <!-- star rating -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/star-rating.css'); ?>" media="all" rel="stylesheet" type="text/css"/>
    <!-- animation -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css'); ?>" media="all" rel="stylesheet" type="text/css"/>
    <!-- google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

    <!-- custom style sheet -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">

    <!-- JQUERY -->
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<header id="site-header">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?= base_url() ?>"><?= isset($title) ? $title : "Corporate Filter"; ?></a>
					<?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?>
						<a class="navbar-brand" href="<?= base_url('dashboard') ?>">Dashboard</a>
					<?php endif; ?>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?>
							<li><a href="<?= base_url('logout') ?>">Logout</a></li>
						<?php else : ?>
							<li><a href="<?= base_url('register') ?>">Register</a></li>
							<li><a href="<?= base_url('login') ?>">Login</a></li>
						<?php endif; ?>
					</ul>
				</div><!-- .navbar-collapse -->
			</div><!-- .container-fluid -->
		</nav><!-- .navbar -->
	</header><!-- #site-header -->

	<main id="site-content" role="main">
		
		
