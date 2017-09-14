<?php
$connect = mysql_connect("localhost:3306","virgo-user","db-virgo");

if (!$connect)
{
  print "<p>Unable to connect to server ".mysql_error()."</p>\n";
  return;
}
$search="";

print "<div class='row'>
		<div class='col-md-12'><form class='form-horizontal' method='post' action='$url"."publications.php'>
		<h2>Search list</h2>
			<div class='form-group'>
				<label for='author' class='control-label col-xs-2'>Author</label>
				<div class='col-xs-10'>
					<input type='text' class='form-control' id='author' placeholder='Author' name='author'>
				</div>
			</div>
			<div class='form-group'>
				<label for='title' class='control-label col-xs-2'>Title</label>
				<div class='col-xs-10'>
					<input type='text' class='form-control' id='title' placeholder='Title' name='title'>
				</div>
			</div>
			<div class='form-group'>
				<label for='max' class='control-label col-xs-2'>Max Results</label>
				<div class='col-xs-10'>
					<select class='form-control' id='max' name='max'>
						<option>5</option>
						<option>10</option>
						<option selected='selected'>25</option>
						<option>50</option>
						<option>100</option>
						<option>500</option>
					</select>
				</div>
			</div>
			<div class='form-group'>
			<div class='control-label col-xs-2'>Sort by</div>
			<div class='col-xs-10'>
			<div class='btn btn-group-justified' data-toggle='buttons'>
				<label class='btn btn-primary'>
					<input type='radio' name='sort' value='first_author'> First Author
				</label>
				<label class='btn btn-primary'>
					<input type='radio' name='sort' value='citations'> Citations
				</label>
				<label class='btn active btn-primary'>
					<input type='radio' name='sort' value='year'>Year
				</label>
			</div>
			</div>
			</div>
			<div class='form-group'>			
				<div class='col-xs-2'></div>
				<div class='col-xs-10'>
					<button type='submit' class='btn btn-primary'>Submit Query</button>
				</div>
			</div>
		</form></div>
		</div>";


// extract form data
$author = $_POST['author'];
$title = $_POST['title'];
$sort = $_POST['sort'];
$max = $_POST['max'];

if ($author != "")
{
	$author_query = "authors like '%$author%'";
} else {
	$author_query = false;
}

if ($title != "")
{
	$title_query = "title like '%$title%'";
} else {
	$title_query = false;
}

if (!$max)
{
	$max = 25;  // default value
}

if ($sort == 'first_author')
{
	$sort_query = 'authors ASC';
} else if ($sort == 'citations') {
	$sort_query = 'year DESC'; // pretty sure this is handled by ADS
} else {
	$sort_query = 'year DESC';
}

// now we need to build the query

if ($title_query && $author_query) 
{	
	$query = "select * from publications where $title_query and $author_query order by $sort_query limit $max";
} else if ($title_query) {
	$query = "select * from publications where $title_query order by $sort_query limit $max";
} else if ($author_query) {
	$query = "select * from publications where $author_query order by $sort_query limit $max";
} else {
	$query = "select * from publications order by $sort_query limit $max";
}


$query=mysql_db_query("virgo", $query);
print mysql_error();

// Everything is in nigel's hands from here on

$np=0;
$link="";
$link2="";

# link2 exists to break up URL when it gets too long

while($row=mysql_fetch_assoc($query))
{
  $np=$np+1;
  if($row['ADS']!="") 
  {
    $row['ADS']=str_replace("&","%26",$row['ADS']);
    if($np<101) $link=$link."bibcode=".$row['ADS']."&";
    if($np>100) $link2=$link2."bibcode=".$row['ADS']."&";
  } else 
  {
    continue;
  }
}

print "<ol>";
if($link!="")
{
  if($sort == "first author")
  {
    print "<h3>Virgo publications sorted by author:</h3>";

    $test2=getthroughproxy("http://adsabs.harvard.edu/cgi-bin/abs_connect?".$link."&nr_to_return=200&sort=AUTHOR&data_type=Custom&format=<li><small><b>%25Y</b>%20%25A%20<font%20color=green><i>%25T</i></font> %20 %25q,%25v,%25p %20<b>(Citations:%20%25c)</b>%20<a%20href=\"%25u\"%20target=blank>ADS%20Abstract</a></small><br><br>","wwwcache.dur.ac.uk","8080");

    if($link2!="") $test2x=getthroughproxy("http://adsabs.harvard.edu/cgi-bin/abs_connect?".$link2."&nr_to_return=200&sort=AUTHOR&data_type=Custom&format=<li><small><b>%25Y</b>%20%25A%20<font%20color=green><i>%25T</i></font> %20 %25q,%25v,%25p %20<b>(Citations:%20%25c)</b>%20<a%20href=\"%25u\"%20target=blank>ADS%20Abstract</a></small><br><br>","wwwcache.dur.ac.uk","8080");

  }else
  {
    if($sort == "year")
    {     
      print "<h3>Virgo publications sorted by year:</h3>";

      $test2=getthroughproxy("http://adsabs.harvard.edu/cgi-bin/abs_connect?".$link."&nr_to_return=200&sort=NDATE&data_type=Custom&format=<li><small><b>%25Y</b>%20%25A%20<font%20color=green><i>%25T</i></font> %20 %25q,%25v,%25p %20<b>(Citations:%20%25c)</b>%20<a%20href=\"%25u\"%20target=blank>ADS%20Abstract</a></small><br><br>","wwwcache.dur.ac.uk","8080");
      if($link2!="") $test2x=getthroughproxy("http://adsabs.harvard.edu/cgi-bin/abs_connect?".$link2."&nr_to_return=200&sort=NDATE&data_type=Custom&format=<li><small><b>%25Y</b>%20%25A%20<font%20color=green><i>%25T</i></font> %20 %25q,%25v,%25p %20<b>(Citations:%20%25c)</b>%20<a%20href=\"%25u\"%20target=blank>ADS%20Abstract</a></small><br><br>","wwwcache.dur.ac.uk","8080");

    } else
    {       
      if($sort == "citations")
      {
	print "<h3>Virgo publications sorted by number of citations:</h3>";

        $test2=getthroughproxy("http://adsabs.harvard.edu/cgi-bin/abs_connect?".$link."&nr_to_return=200&sort=CITATIONS&data_type=Custom&format=<li><small><b>%25Y</b>%20%25A%20<font%20color=green><i>%25T</i></font> %20 %25q,%25v,%25p %20<b>(Citations:%20%25c)</b>%20<a%20href=\"%25u\"%20target=blank>ADS%20Abstract</a></small><br><br>","wwwcache.dur.ac.uk","8080");
	if($link2!="") $test2x=getthroughproxy("http://adsabs.harvard.edu/cgi-bin/abs_connect?".$link2."&nr_to_return=200&sort=CITATIONS&data_type=Custom&format=<li><small><b>%25Y</b>%20%25A%20<font%20color=green><i>%25T</i></font> %20 %25q,%25v,%25p %20<b>(Citations:%20%25c)</b>%20<a%20href=\"%25u\"%20target=blank>ADS%20Abstract</a></small><br><br>","wwwcache.dur.ac.uk","8080");
      }
      else
      {
	$test2=getthroughproxy("http://adsabs.harvard.edu/cgi-bin/abs_connect?".$link."&nr_to_return=200&sort=NDATE&data_type=Custom&format=<li><small><b>%25Y</b>%20%25A%20<font%20color=green><i>%25T</i></font> %20 %25q,%25v,%25p %20<b>(Citations:%20%25c)</b>%20<a%20href=\"%25u\"%20target=blank>ADS%20Abstract</a></small><br><br>","wwwcache.dur.ac.uk","8080");
        if($link2!="") $test2x=getthroughproxy("http://adsabs.harvard.edu/cgi-bin/abs_connect?".$link2."&nr_to_return=200&sort=NDATE&data_type=Custom&format=<li><small><b>%25Y</b>%20%25A%20<font%20color=green><i>%25T</i></font> %20 %25q,%25v,%25p %20<b>(Citations:%20%25c)</b>%20<a%20href=\"%25u\"%20target=blank>ADS%20Abstract</a></small><br><br>","wwwcache.dur.ac.uk","8080");
      }
    }
  }
  $test2['content']=highlight($test2['content'],$_POST['string']);
  if($link2!="") $test2x['content']=highlight($test2x['content'],$_POST['string']);  
  print "$test2[content]\n";
  if($link2!="") print "$test2x[content]\n";
  print "</ol>";
} else
{
	print "Sorry, no results were found.";
}

function highlight($instring,$searchstring)
{
  if(!$searchstring) return $instring;
  $start=0;
  do
  {
    $n=strpos(strtolower($instring),strtolower($searchstring),$start);
    if($n===false)
    {
      break;
    } else 
    {
      $x=strlen($searchstring);
      $instring=substr($instring,0,$n)."<font color=red>".substr($instring,$n,$x)."</font>".substr($instring,$n+$x);
      $start=$n+$x+16;
    } 
  } while(1);
  return $instring;
}

function getthroughproxy($myfiles, $proxyhost, $proxyport)
{
  $errno="";
  $errstr="";
  $zeile="";
  $timeout=30.0;
  $datei = fsockopen($proxyhost, $proxyport, $errno, $errstr,$timeout); 
  if( !$datei ) 
    {
      fclose($resultfile); 
      return array('headers'=>false,
		   'content'=>false,
		   'errno'=>$errno,
		   'errstr'=>$errstr);
      print "proxy not available";
      // You'll probably want to change this with return false;
      // to use in an 
      // if($file=getthroughproxy){} manner.
      // Well, it's up to You
    } else { 
      fputs($datei,"GET $myfiles HTTP/1.0\n\n");
      while (!feof($datei)) 
	{
	  $zeile =$zeile.fread($datei,4096);
	}
    }
  fclose($datei);
  return array('headers'=>substr($zeile,0,strpos($zeile,"\r\n\r\n")),
	       'content'=>substr($zeile,strpos($zeile,"\r\n\r\n")+4),
	       'errno'=>$errno,
	       'errstr'=>$errstr);
}

?>
</ol>

</td>
</table>
