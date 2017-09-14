<?php
/* Global vars for the VIRGO website.
 *
 * Created 2015-02-07 by Josh Borrow
 * Institute for Computational Cosmology, Durham University
 * Contact: josh.borrow@gmail.com
 */

global $url, $static, $media, $local_media, $page_names, $page_urls, $current_project_names, $current_project_handles, $inst_names, $inst_handles, $data_handles, $data_links;

$url = "http://virgo.dur.ac.uk/";
$static = $url . "static/";
$media = $url . "media/";
$local_media = "media/";

$page_names = array(
	"Home",
	"About",
	"Projects",
	"Publications",
	"People",
	"Data",
);
$page_urls = array(
	$url . "index.php",
	$url . "about.php",
	$url . "projects.php",
	$url . "publications.php",
	$url . "people.php",
	$url . "data.php",
);

$project_names = array(  # The 'nicely' formatted name
	"EAGLE",
	"Simulations of Galaxy Clusters",
	"Local Group",
	"COCO",
	"Millennium",
);
$project_handles = array(  # The name of the folder in media/projects
	"eagle",
	"clusters",
	"lclgrp",
	"coco",
	"millenium",
);

$inst_names = array(
	"Institute for Computational Cosmology",
	"The University of Edinburgh",
	"Liverpool John Moores University",
	"The University of Manchester",
	"The University of Nottingham",
	"The University of Sussex",
	"Max Planck Institute for Astrophysics",
	"Heidelberg Institute for Theoretical Studies",
	"Leiden Observatory",
	"Johns Hopkins University",
	"University of Victoria",
	"NAOC",
);

$inst_handles = array(
	"ICC",
	"edinburgh",
	"LJM",
	"manchester",
	"notts",
	"sussex",
	"MPIA",
	"HITS",
	"leiden",
	"JHU",
	"victoria",
	"NAOC",
);

$data_handles = array(
	"eagle",
	"mil",
	"mpamil",
	"durmil",
	"gavomil",
	"icc",
);

$data_links = array(
	"http://icc.dur.ac.uk/Eagle/database.php",
	"http://galaxy-catalogue.dur.ac.uk:8080/Millennium/Help?page=registration",
	"http://gavo.mpa-garching.mpg.de/Millennium/Help?page=registration",
	"http://galaxy-catalogue.dur.ac.uk:8080/Millennium/",
	"http://gavo.mpa-garching.mpg.de/Millennium/",
	"http://icc.dur.ac.uk/data/",
);
