<?php include_once("etc/functions.php"); include_once("etc/globals.php"); $current_page="Home"?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("etc/head.php"); ?>
		<link href="<?php echo $static ?>home/cover.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<div class="site-wrapper wrapper">
			<div class="site-wrapper-inner">
				<div class="cover-container">
					<div class="masthead clearfix">
						<div class="inner">
							<img class="masthead-brand" src="<?php echo $media ?>logo_white.png" alt="VIRGO"/>
							<nav>
								<ul class="nav masthead-nav">
									<?php echo navbar_li_gen($page_names, $page_urls, $current_page); ?>
								</ul>
							</nav>
						</div>
					</div>
					<div class="inner cover">
						<h1>The Virgo Consortium</h1>
						<h2>For Cosmological Supercomputer Simulations</h2><br/>
						<p><a href="<?php echo $url; ?>about.php"><button type="button" class="btn btn-lg btn-primary">Find out more &raquo;</button></a></p>
					</div>
				</div>
			</div>
		</div>
		<style> footer, .footer, #push { display:none; } </style>

		<?php include_once("etc/foot.php"); ?>

	</body>
</html>




