<?php include_once("etc/functions.php"); include_once("etc/globals.php"); $current_page="About"?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("etc/head.php"); ?>
		<link href="<?php echo $static; ?>projects/carousel.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
	<div id="wrap">
		<?php echo navbar_full_gen($page_names, $page_urls, $current_page); ?>
		
		<div class="container main">
			<div class="row">
				<div class="col-sm-3 col-md-3 sidebar">
					<img src="<?php echo $media; ?>logo.png" alt="VIRGO" id="VIRGO"/>
					<?php $current_handle = $_GET['project']; ?>
					<h1>About</h1>
					<ul class="nav nav-sidebar">
						<li class="<?php if	(!in_array($current_handle, $inst_handles)) echo "active"; ?>"><a href="<?php echo $url; ?>about.php">General</a></li>
					</ul>
					<h2>Institutions</h2>
					<ul class="nav nav-sidebar">
						<?php
						echo sidebar_li_gen($inst_names, $inst_handles, "$url/about.php", $current_handle);
						?>
					</ul>
				</div>
				<div class="col-md-9">
					<?php
					if (!in_array($current_handle, $inst_handles))
					{
						$current_handle = "none";
					}
					echo about_gen($current_handle);
					?>
				</div>
			</div>
		</div>
		</div>			

		<?php include_once("etc/foot.php"); ?>

	</body>
</html>

