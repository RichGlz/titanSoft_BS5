﻿<?php
require '../../include/db_conn.php';
page_protect();
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Document</title>
	
	<link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
	<script type="text/javascript" src="../../js/Script.js"></script>
	<link rel="stylesheet" href="../../css/dashMain.css">
	<link rel="stylesheet" type="text/css" href="../../css/entypo.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<style>
		.page-container .sidebar-menu #main-menu li#dash > a {
			background-color: #2b303a;
			color: #ffffff;
		}

	</style>

</head>


<body class="page-body  page-fade" onload="collapseSidebar()">

<div class="page-container sidebar-collapsed" id="navbarcollapse">	
	
	<div class="sidebar-menu">

		<header class="logo-env">
		
			<!-- logo -->
			<div class="logo">
				<a href="main.php">
					<img src="../../images/logo.png" alt="" width="192" height="80" />
				</a>
			</div>
			
			<!-- logo colapsar ícono -->
			<div class="sidebar-collapse" onclick="collapseSidebar()">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- agregue la clase "with-animation" si desea que la barra lateral tenga animación durante la transición de expansión / colapso -->
					<i class="entypo-menu"></i>
				</a>
			</div>
	
		</header>
		
		<?php include('nav.php'); ?>
		
	</div>

	<div class="main-content">

		<div class="row">
			
			<!-- Información de perfil y notificaciones -->
			<div class="col-md-6 col-sm-8 clearfix">	
					
		</div>
			
			
			<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
			
			<ul class="list-inline links-list pull-right">

				<li>Bienvenid@ <?php echo $_SESSION['full_name']; ?> 
				</li>					
			
				<li>
					<a href="logout.php">
						Cerrar Sesión <i class="entypo-logout right"></i>
					</a>
				</li>
			</ul>
			
		</div>
				
	</div>

		<h2>ConfiguroWeb GYM | Panel de Control</h2>

		<hr>

		<div class="col-sm-3"><a href="revenue_month.php">			
			<div class="tile-stats tile-red">
				<div class="icon"><i class="entypo-users"></i></div>
					<div class="num" data-postfix="" data-duration="1500" data-delay="0">
					<h2>Dinero recibido este Mes</h2><br>	
					<?php
						date_default_timezone_set('America/Bogota');
						$date  = date('Y-m');
						$query = "select * from enrolls_to WHERE  paid_date LIKE '$date%'";

						//echo $query;
						$result  = mysqli_query($con, $query);
						$revenue = 0;
						if (mysqli_affected_rows($con) != 0) {
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									$query1="select * from plan where pid='".$row['pid']."'";
									$result1=mysqli_query($con,$query1);
									if($result1){
										$value=mysqli_fetch_row($result1);
										$revenue = $value[4] + $revenue;
									}
								}
						}
						echo "$".$revenue;
						?>
					</div>
			</div></a>
		</div>
			

		<div class="col-sm-3"><a href="table_view.php">			
			<div class="tile-stats tile-green">
				<div class="icon"><i class="entypo-chart-bar"></i></div>
					<div class="num" data-postfix="" data-duration="1500" data-delay="0">
					<h2>Miembros <br>Totales</h2><br>	
						<?php
						$query = "select COUNT(*) from users";

						$result = mysqli_query($con, $query);
						$i      = 1;
						if (mysqli_affected_rows($con) != 0) {
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
										echo $row['COUNT(*)'];
								}
						}
						$i = 1;
						?>
					</div>
			</div></a>
		</div>	
				
		<div class="col-sm-3"><a href="over_members_month.php">			
			<div class="tile-stats tile-aqua">
				<div class="icon"><i class="entypo-mail"></i></div>
					<div class="num" data-postfix="" data-duration="1500" data-delay="0">
					<h2>Usuarios Ingresados este mes</h2><br>	
						<?php
						date_default_timezone_set("America/Bogota"); 
						$date  = date('Y-m');
						$query = "select COUNT(*) from users WHERE joining_date LIKE '$date%'";

						//echo $query;
						$result = mysqli_query($con, $query);
						$i      = 1;
						if (mysqli_affected_rows($con) != 0) {
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
										echo $row['COUNT(*)'];
								}
						}
						$i = 1;
						?>
					</div>
			</div></a>			
		</div>

		<div class="col-sm-3"><a href="view_plan.php">			
			<div class="tile-stats tile-blue">
				<div class="icon"><i class="entypo-rss"></i></div>
					<div class="num" data-postfix="" data-duration="1500" data-delay="0">
					<h2>Planes de Entreno Disponibles</h2><br>	
						<?php
						$query = "select COUNT(*) from plan where active='yes'";

						//echo $query;
						$result  = mysqli_query($con, $query);
						$i = 1;
						if (mysqli_affected_rows($con) != 0) {
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
										echo $row['COUNT(*)'];
								}
						}
						$i = 1;
						?>
					</div>
			</div></a>
		</div>
			

			
   
		<?php include('footer.php'); ?>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</body>
</html>
