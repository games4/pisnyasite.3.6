<?php 
include_once("blocks/func.inc.php");
include("blocks/db.php");

// 2023-03-27
// визначаю загальну кількість записів у запиті
$result00 = mysql_query("SELECT COUNT(DISTINCT kompozycija) FROM view");
verification_query($result00);
$temp = mysql_fetch_array($result00);
$posts = $temp[0];
// echo "<p>всього записів в запиті view_compozition_count - $posts</p>";
// визначаю загальну кількість сторінок 

$result = mysql_query ("SELECT view.date FROM view, kompozycija WHERE view.kompozycija = kompozycija.id ORDER BY view.date DESC, view.num DESC", $db);
verification_query($result);
$myrow = mysql_fetch_array ($result);
$date = date("Y-m-d", strtotime($myrow["date"]));

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://pisnya.org.ua/</loc>
    <lastmod>'.$date.'</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>';
echo '
  <url>
    <loc>https://pisnya.org.ua/albomy.php</loc>
    <lastmod>'.$date.'</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>';

$result_kompozycija = mysql_query ("SELECT DISTINCT kompozycija.id, kompozycija.lastmod_date FROM view, kompozycija WHERE kompozycija.id = view.kompozycija ORDER BY view.date DESC", $db); 
verification_query($result_kompozycija);
while ($myrow_kompozycija = mysql_fetch_array($result_kompozycija))
{
  echo '
  <url>
    <loc>https://pisnya.org.ua/kompozycija.php?id='.$myrow_kompozycija["id"].'</loc>
    <lastmod>'.date("Y-m-d", strtotime($myrow_kompozycija["lastmod_date"])).'</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>
  </url>';
}

$result_vydannya = mysql_query ("SELECT DISTINCT vydannya.id, vydannya.lastmod_date FROM view, kompozycija, vydannya WHERE view.kompozycija = kompozycija.id AND kompozycija.vydannya = vydannya.id ORDER BY vydannya.id DESC", $db); 
verification_query_2($result_vydannya);
while ($myrow_vydannya = mysql_fetch_array($result_vydannya))
{
  echo '
  <url>
    <loc>https://pisnya.org.ua/release.php?id='.$myrow_vydannya["id"].'</loc>
    <lastmod>'.date("Y-m-d", strtotime($myrow_vydannya["lastmod_date"])).'</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>
  </url>';
}

echo '
</urlset>';

?>