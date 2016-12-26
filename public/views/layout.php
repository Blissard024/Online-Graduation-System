<html>
<head>
	<title><?php echo $page_title ?></title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/navigation-style.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/<?php echo $cssPath ?>">
	<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$("html").addClass("js");
	</script>
</head>
<body>
	<div class="container">
		<div class="sidebar">

			<?php
				if(isset($_SESSION["admin"])){
					include ("admin_navigation.view.php");
				} else {
					include ("student_navigation.view.php");
				}
			 ?>
		</div>
		<div class="content">

			<div class="content-container">
				<div class="content-header">
					<h2>
						<?php echo (isset($page_header)) ? $page_header : $page_title; ?>
					</h2>
				</div>
				<div class="content-body">
					<?php include($phpPath); ?>
				</div> <!-- end of content-body -->
			</div> <!-- end of content-container -->
		</div> <!-- end of content -->
	</div>

	<script type="text/javascript" src="js/nav_menu_script.js"></script>

</body>
</html>
