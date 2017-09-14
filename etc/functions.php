<?php
/* Global functions for the VIRGO website.
 *
 * Created 2015-02-07 by Josh Borrow
 * Institute for Computational Cosmology, Durham University
 * Contact: josh.borrow@gmail.com
 */

require_once("etc/globals.php");

function navbar_li_gen($page_names, $page_urls, $current_page=NULL)
{
	/* Generates the <li>'s required for creating a bootstrap navbar, given
	 * the two obvious lists. 
	 *
	 * Returns the set of <li>'s as a string. */
	$navbar_li = "";
	
	for ($i=0; $i<count($page_names); $i++)
	{
		$this_page = $page_names[$i];
		$this_url = $page_urls[$i];

		if ($this_page == $current_page) {
			$class = "active";
		} else {
			$class = "";
		}

		$navbar_li .= "<li class=\"$class\"><a href=\"$this_url\">$this_page</a></li>\n";
	}
	return $navbar_li;
}

function navbar_full_gen($page_names, $page_urls, $current_page=NULL)
{
	/* Generates a full navbar for use with bootstrap (everything including nav)
	 * Returns as a string.
	 * For more information, see navbar_li_gen
	 */
	$li = navbar_li_gen($page_names, $page_urls, $current_page);
	
	return "<nav class=\"navbar navbar-default navbar-fixed-top\">
	<div class=\"container\">
		<div class=\"navbar-header\">
			<button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
				<span class=\"sr-only\">Toggle navigation</span>
				<span class=\"icon-bar\"></span>
				<span class=\"icon-bar\"></span>
				<span class=\"icon-bar\"></span>
			</button>
		</div>
		<div id=\"navbar\" class=\"collapse navbar-collapse\">
			<ul class=\"nav navbar-nav\">
				$li
			</ul>
		</div>
	</div></nav>";
}

function sidebar_li_gen($page_names, $page_handles, $page_url, $current_handle=NULL)
{
	/* GeneratesA the <li>'s required for creating a bootstrap sidebar, given
	 * the two obvious lists. 
	 *
	 * Returns the set of <li>'s as a string. */
	$navbar_li = "";
	
	for ($i=0; $i<count($page_names); $i++)
	{
		$this_page = $page_names[$i];
		$this_handle = $page_handles[$i];
		$this_url = "$page_url?project=$this_handle";

		if ($this_handle == $current_handle) {
			$class = "active";
		} else {
			$class = "";
		}

		$navbar_li .= "<li class=\"$class\"><a href=\"$this_url\">$this_page</a></li>\n";
	}
	return $navbar_li;
}

function preview_gen($filename, $link=NULL, $chars=300, $allowed="<h1><h2><h3><h4><h5><h6><img>", $dots=true)
{
	/* Grabs the contents of the file up to $chars and cleans it of html stuff,
	 * as well as adding on a ... on the end.
	 * Also links to $filename if no $link is present.
	 */
	if ($link == NULL) {$link = $filename;}
	$handle = fopen($filename, "r");
	$contents = fread($handle, $chars);
	fclose($handle);	
	
	$stripped = strip_tags($contents, $allowed);
	$preview = "<a href=\"$link\">$stripped</a>";
	
	if ($dots) { return $preview."..."; }
	else { return $preview; }
}

function get_single_project_image($project_handle, $subdir='projects')
{
	/* Grabs a single image out of the project directory */
	global $local_media, $media;
	$image_dir_list = list_no_hidden("$local_media"."$subdir/$project_handle/images");
	$image = $image_dir_list[0];
	return "$media"."$subdir/$project_handle/images/$image";
}

function project_preview_gen($handle, $subdir='projects')
{
	/* Uses preview_gen and creates a bootstrap column with the image so they go nicely next to each other */
	global $local_media;
	$local_info_url = "$local_media"."$subdir/$handle/info.html";
	$text = preview_gen($local_info_url, $url."projects.php?project=$handle");
	$image = get_single_project_image($handle);
	$preview = "<div class=\"row\"><div class=\"col-md-4 projimg\"><img src=\"$image\"></div><div class=\"col-md-8\">$text</div></div>";
	return $preview;
}

function data_preview_gen($handle, $link)
{
	/* Uses preview_gen and creates a bootstrap column with the image so they go nicely next to each other */
	global $local_media;
	$local_info_url = "$local_media"."data/$handle/info.html";
	$text = preview_gen($local_info_url, $link, $chars=1000, $allowed="<h1><h2><h3><h4><h5><h6><img>", $dots=false);
	$image = get_single_project_image($handle, $subdir='data');
	$preview = "<div class=\"row\"><div class=\"col-md-4 projimg\"><img src=\"$image\"></div><div class=\"col-md-8\">$text</div></div>";
	return $preview;
}

function to_urls($handles, $initial_url, $specifier="project")
{
	/* Converts an array of handles to urls, using the GET method
	 */
	$urls = array();
	foreach ($handles as $handle)
	{
		$url = "$initial_url?$specifier=$handle";
		array_push($urls, $url);
	}
	return $urls;
}

function list_no_hidden($dir)
{
	/* Returns the contents of a directory with hidden files removed */
	$unclean = scandir($dir);
	$clean = array();

	foreach ($unclean as $fname)
	{
		if ($fname[0] == ".")
		{
			continue;
		} else {
			array_push($clean, $fname);
		}
	}
	return $clean;
}

function carousel_controls($name)
{
	/* $name is the id of the carousel. Returns a string containing left/right carousel controls */
	return "<a class=\"left carousel-control\" href=\"#$name\" role=\"button\" data-slide=\"prev\">
	<span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span>
	<span class=\"sr-only\">Previous</span>
</a>
<a class=\"right carousel-control\" href=\"#$name\" role=\"button\" data-slide=\"next\">
	<span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span>
	<span class=\"sr-only\">Next</span>
	</a>";
}

function project_gen($handle)
{
	/* Generates the project page for each individual project, with the bootstrap carousel. */
	global $media, $local_media;

	$local_image_dir = $local_media."projects/$handle/images/";
	$local_info = $local_media."projects/$handle/info.html";
	$local_captions = $local_media."projects/$handle/captions.php";	

	$file_handle = fopen($local_info, "r");
	$content = fread($file_handle, filesize($local_info));
	fclose($file_handle);

	# We must take the title off to 'slot' the carousel in.
	$title = strtok($content, "\n");
	$content = preg_replace('/^.+\n/', "", $content);

	$image_list = list_no_hidden($local_image_dir);

	# Grab the captions - does not have to be present
	
	if (file_exists($local_captions))
	{
		include($local_captions);
	} else {
		$raw_captions = array();
	}

	$captions = get_captions($image_list, $raw_captions);

	$carousel = "<div id=\"project_carousel\" class=\"carousel slide\" data-ride=\"carousel\">\n";  # see bootstrap docs
	$indicators = "<ol class=\"carousel-indicators\">\n";
	$carousel_inner = "<div class=\"carousel-inner\" role=\"listbox\">\n";

	$thumb_exists = false;
	for ($i=0; $i<count($image_list); $i++)
	{
		$img = $image_list[$i];

		if ($img == "001thumbnail.jpg")
		{
			$thumb_exists = true;
			continue;
		}

		$image_link = $media."projects/$handle/images/$img";
		$this_caption_text = $captions[$i];
		$caption = "<div class='carousel-caption'>$this_caption_text</div>";

		if ($i == 0 || ($i == 1 && $thumb_exists))
		{
			$class = "item active";  # or we won't know what to start on!
		} else {
			$class = "item";
		}
		$indicators .= "<li data-target=\"project_carousel\" data-slide-to=\"$i\">\n";
		$carousel_inner .= "<div class=\"$class\">
			<img src=\"$image_link\">
			$caption
		</div>\n";
	}
	$indicators .= "</ol>\n";
	$carousel .= $indicators;
	$carousel .= $carousel_inner;
	$controls = carousel_controls("project_carousel");
		
	return "$title\n$carousel$controls</div></div>$content";
}

function get_captions($image_list, $captions)
{
	/* $captions should be a 2d array of the form:
	 * $captions = array(array(<some img filename>, <some caption>), array(<some img filebname>, <some caption>), ...)
	 * with image list being a list of the image names that are in captions,
	 * $image_list = array(<some img filename>, <some img filename>, ...)
	 * This function returns an array of captions in the same order as the image list */

	$final_captions = array();

	foreach ($captions as $caption)
	{
		$this_filename = $caption[0];
		$this_caption = $caption[1];

		if (in_array($this_filename, $image_list))
		{
			$index = array_search($this_filename, $image_list);
			$final_captions[$index] = $this_caption;
		}  # no else condition, we just want it left empty
	}

	return $final_captions;
}

function get_logo($handle, $page="about")
{
	global $media, $local_media;
	$dir_list = list_no_hidden($local_media."about/$handle/");
	if (in_array("logo.png", $dir_list))
	{
		$fname = "logo.png";
	} else if (in_array("logo.jpg", $dir_list)) {
		$fname = "logo.jpg";
	}
	return $media."about/$handle/$fname";
}

function about_gen($handle)
{
	/* Similar to project_gen but simpler. Only really needs to import */
	global $local_media;

	include_once($local_media."about/$handle/info.php"); /* PHP so they can have scripts */
}
