<?php

require_once("libs/database.php");

$con = new Database();
$pr = "No Name";
if ($con->connect()) {
	$pr = "conec";
	$query = $con->connect()->prepare("SELECT * FROM studio.settings");

	if ($query->execute()) {
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$titulo = $result[0]["Titulo_pr"];
		$Usuario = $result[0]["usuario"];

		$logo_principal = $result[0]["logo_orden"];
	} else {
		$err = $query->errorInfo();
		echo $err;
	}
} else {
	$pr = "No name";
}


?>

<!DOCTYPE html>
<html lang="en">



<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Aj Studio</title>
	<!--favicon-->
	<link rel="icon" href="<?php echo constant('URL') ?>public/assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="<?php echo constant('URL') ?>public/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?php echo constant('URL') ?>public/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?php echo constant('URL') ?>public/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="<?php echo constant('URL') ?>public/assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?php echo constant('URL') ?>public/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/app.css" />
	<link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/dark-header.css" />
	<link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/dark-theme.css" />
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<!--header-->
		<header class="top-header">
			<nav class="navbar navbar-expand">
				<div class="sidebar-header">
					<div class="d-none d-lg-flex">
						<img src="<?php echo constant('URL').$logo_principal ?>" class="logo-icon-2" alt="Logo" />
					</div>
					<div>
						<h4 class="d-none d-lg-flex logo-text"><?php echo $titulo ?></h4>
					</div>
					<a href="javascript:;" class="toggle-btn ml-lg-auto"> <i class="bx bx-menu"></i>
					</a>
				</div>
				<div class="flex-grow-1 search-bar">

				</div>
				<div class="right-topbar ml-auto">
					<ul class="navbar-nav">
						<li class="nav-item search-btn-mobile">
							<a class="nav-link position-relative" href="javascript:;"> <i class="bx bx-search vertical-align-middle"></i>
							</a>
						</li>


						<li class="nav-item dropdown dropdown-user-profile">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
								<div class="media user-box align-items-center">
									<div class="media-body user-info">
										<p class="user-name mb-0"><?php echo $Usuario ?></p>
										<p class="designattion mb-0">En linea</p>
									</div>
									<img src="https://www.schoss.com.ar/images/avatar-woman.png" class="user-img" alt="user avatar">
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
								<a class="dropdown-item" href="<?php echo constant('URL') ?>Settings/Settings"><i class="bx bx-cog"></i><span>Settings</span></a>
								<a class="dropdown-item" href="<?php echo constant('URL') ?>"><i class="bx bx-tachometer"></i><span>Dashboard</span></a>
								<div class="dropdown-divider mb-0"></div> <a class="dropdown-item" href="javascript:;"><i class="bx bx-power-off"></i><span>Logout</span></a>
							</div>
						</li>

					</ul>
				</div>
			</nav>
		</header>
		<!--end header-->
		<!--navigation-->
		<div class="nav-container">
			<div class="mobile-topbar-header">
				<div class="">
					<img src="<?php echo constant('URL') ?>public/assets/images/aj.jpeg" class="logo-icon-2" alt="" />
				</div>
				<div>
					<h4 class="logo-text">AjEstudio</h4>
				</div>
				<a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
				</a>
			</div>
			<nav class="topbar-nav">

				<?php require 'sidebar2.php'; ?>

			</nav>
		</div>
		<!--end navigation-->
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">