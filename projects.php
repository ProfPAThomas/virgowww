<?php include_once("etc/functions.php"); include_once("etc/globals.php"); $current_page="Projects"?>
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
					<h1>Projects</h1>
					
					<ul class="nav nav-sidebar">
						<?php
						$current_project = $_GET['project'];
						echo sidebar_li_gen($project_names, $project_handles, "$url/projects.php", $current_project);
						?>
					</ul>
				</div>
				<div class="col-md-9">
					<?php
					if (!isset($_GET['project']) || $_GET['project']=='list')
					{
						// Create previews
						echo "<h1>List of Projects</h1>";	
						echo "<p>Projects ordered from rougly newest to oldest";
						for ($i=0; $i<count($project_names); $i++)
						{
							$proj_handle = $project_handles[$i];
							echo project_preview_gen($proj_handle);
						}
					} else {
						// Grab and show the page
						$project = $_GET['project'];
						echo project_gen($project);
					}
					?>
				</div>
			</div>
		</div></div>
	</div>

		<?php include_once("etc/foot.php"); ?>

	</body>
</html>

