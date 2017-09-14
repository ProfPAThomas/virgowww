<?php include_once("etc/functions.php"); include_once("etc/globals.php"); $current_page="People"?>
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
					<h1>People</h1>
					<p>The people listed to the right are core members of the Virgo Consortium, who actively are involved with current Virgo projects. You can find out more about each individual by going to their personal webpages.</p>
				    <p>In addition at any time there are also typically a further 10 academics, 30 postdocs and 30 PhD students working on Virgo related projects.</p>
				</div>
				<div class="col-md-9">
					<h1>Virgo Members</h1>
						<h2>United Kingdom</h2>
						<h5>Durham University</h5>
						<ul>
								<li><a href="http://community.dur.ac.uk/r.g.bower/Site/HomePage.html/">R. G. Bower</a></li>
								<li><a href="http://star-www.dur.ac.uk/~csf/">C.S. Frenk</a> (co-PI)</li>
								<li><a href="http://star-www.dur.ac.uk/~arj/">A. R. Jenkins</a></li>
								<li><a href="http://icc.dur.ac.uk/~tt/">T. Theuns</a></li>
						</ul>
						<h5>University of Edinburgh</h5>
						<ul>
								<li><a href="http://www.roe.ac.uk/~jap/">J. A. Peacock</a></li>
						</ul>
						<h5>Liverpool John Moores</h5>
						<ul>
								<li><a href="http://www.astro.ljmu.ac.uk/~igm/contact.html">I. G. McCarthy</a></li>
								<li><a href="http://www.astro.ljmu.ac.uk/~astrcrai/">R. A. Crain</a></li>
						</ul>
						<h5>University of Manchester</h5>
						<ul>
								<li><a href="http://www.manchester.ac.uk/research/scott.kay/">S. T. Kay</a></li>
						</ul>
						<h5>University of Nottingham</h5>
						<ul>
								<li><a href="http://www.nottingham.ac.uk/~ppzfrp/">F. R. Pearce</a></li>
						</ul>
						<h5>University of Sussex</h5>
						<ul>
								<li><a href="http://www.sussex.ac.uk/profiles/2672">P. A. Thomas</a></li>
								<li><a href="http://www.sussex.ac.uk/profiles/219022">Ilian Iliev</a></li>
								<li><a href="http://www.sussex.ac.uk/profiles/192372">Stephen Wilkins</a></li>
						</ul>
						
						<h2>Germany</h2>
						<h5>Heidelberg Institute for Theoretical Studies (HITS)</h5>
						<ul>
								<li><a href="http://www.h-its.org/en/research/tap/people/springel/">V. R. Springel</a></li>
						</ul>
						<h5>Max-Planck-Institut fuer Astrophysik</h5>
						<ul>
								<li><a href="http://www.mpa-garching.mpg.de/~swhite/">S. D. M. White</a> (co-PI)</li>
						</ul>

						<h2>Netherlands</h2>
						<ul>
								<li><a href="http://strw.leidenuniv.nl/~schaye">J. Schaye</a></li>
						</ul>

						<h2>Canada</h2>
						<ul>
								<li><a href="http://www.astro.uvic.ca/~jfn/mywebpage/home.html">J. Navarro</a></li>
						</ul>

						<h2>China</h2>
						<h5>NAOC/Durham University</h5>
						<ul>
								<li><a href="http://sourcedb.naoc.cas.cn/en/enaoexpert/200907/t20090706_2000322.html">L. Gao</a></li>
						</ul>

						<h2>USA</h2>
						<h5>Johns Hopkins University</h5>
						<ul>
								<li><a href="http://www.sdss.jhu.edu/~szalay/">A. Szalay</a></li>
								<li><a href="http://physics-astronomy.jhu.edu/directory/gerard-lemson/">G. Lemson</a></li>
						</ul>
				
				</div>
			</div>
		</div></div>
	</div>

		<?php include_once("etc/foot.php"); ?>

	</body>
</html>

