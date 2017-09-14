<?php include_once("etc/functions.php"); include_once("etc/globals.php"); $current_page="Data"?>
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
			<div class="wrapper">
			<div class="row">
				<div class="col-sm-3 col-md-3 sidebar">
					<img src="<?php echo $media; ?>logo.png" alt="VIRGO" id="VIRGO"/>
					<h1>Data Releases</h1>

					<p>Click on each one to find out more from their project website, or to download the data.</p>
					
				</div>
				<div class="col-md-9">
					<?php
						// Create previews
						echo "<h1>List of Data</h1>";	
						for ($i=0; $i<count($data_handles); $i++)
						{
							$proj_handle = $data_handles[$i];
							$proj_link = $data_links[$i];
							echo data_preview_gen($proj_handle, $proj_link);
						}
					?>
				</div>
			</div>
		</div></div>
	</div>

		<?php include_once("etc/foot.php"); ?>

	</body>
</html>

