<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Car Inventory - <?php echo $mod_name;?></title>
	
	 <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
	
	<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	
	<!-- Data tables -->
	<link href="vendor/dataTables/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="vendor/dataTables/css/responsive.dataTables.min.css" rel="stylesheet">
	<script src="vendor/dataTables/js/jquery.dataTables.min.js"></script>
	<script src="vendor/dataTables/js/dataTables.responsive.min.js"></script>
	<!--<link href="vendor/dataTables/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<script src="vendor/dataTables/js/dataTables.bootstrap.min.js"></script>-->

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html">Car Inventory</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>
    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php?module=manufacturer">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Manufacturers</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?module=model">
            <i class="fas fa-fw fa-table"></i>
            <span>Models</span></a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="index.php?module=model&action=viewInventory">
            <i class="fas fa-fw fa-table"></i>
            <span>View Inventory</span></a>
        </li>
      </ul>

      <div id="content-wrapper">
		<!-- /.container-fluid -->

