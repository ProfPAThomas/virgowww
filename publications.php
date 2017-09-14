<?php include_once("etc/functions.php"); include_once("etc/globals.php"); $current_page="Publications"?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("etc/head.php"); ?>
	</head>

	<body>
	<div id="wrap">
		<?php echo navbar_full_gen($page_names, $page_urls, $current_page); ?>
		
		<div class="container main">
			<div class="row">
				<div class="col-sm-3 col-md-3 sidebar">
					<img src="<?php echo $media; ?>logo.png" alt="VIRGO" id="VIRGO"/>
					
					<h2>Publications</h2>
					<ul class="nav nav-sidebar">	
						<li class="<?php if (!isset($_GET['id'])) echo "active"; ?>"><a href="<?php echo $url?>publications.php">Current Publications</a></li>
						<li class="<?php if ($_GET['id'] == "login") echo "active"; ?>"><a href="<?php echo $url?>publications.php?id=login">Database Login</a></li>
					</ul>
				</div>
				<div class="col-md-9">
					<h1>Virgo Publications (Since 1996)</h1>
					<p>This list includes papers written by the Virgo Consortium and associates, as well as a selection of papers that make extensive use of Virgo simulation data (e.g. by the 2dFGRS collaboration).</p>
					<?php
					if (!isset($_GET['id'])) include_once("etc/publications.php");
					else if ($_GET['id'] == "login") echo "<p>Sorry, but this page is currently unavailable. Please check back later.</p>";
					else echo "Sorry, we couldn't find the page you were looking for. Please try going back using the links on the left.";
					?>
				</div>
			</div>
		</div>			
	</div>
		<?php include_once("etc/foot.php"); ?>

	</body>
</html>

