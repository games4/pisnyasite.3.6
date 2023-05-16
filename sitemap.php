<?php 
include_once("blocks/func.inc.php");
include("blocks/db.php");

// 2023-03-27
// визначаю загальну кількість записів в базі даних
$result00 = mysql_query("SELECT COUNT(*) FROM view");
verification_query($result00);
$temp = mysql_fetch_array($result00);
$posts = $temp[0];
// echo "<p class='p1'>всього записів в базі даних view - $posts</p>";
// визначаю загальну кількість сторінок 

$result = mysql_query ("SELECT * FROM view, kompozycija WHERE view.kompozycija = kompozycija.id ORDER BY view.date DESC, view.num DESC", $db);
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

$result_k = mysql_query ("SELECT view.date, kompozycija.id, kompozycija.lastmod_date, kompozycija.header, vykonavec.title AS vykonavec FROM view, kompozycija, vykonavec WHERE kompozycija.id = view.kompozycija AND kompozycija.vykonavec1 = vykonavec.id ORDER BY view.date DESC, view.num DESC", $db); 
verification_query($result_k);

while ($myrow_k = mysql_fetch_array($result_k))
{
  echo '
  <url>
    <loc>https://pisnya.org.ua/kompozycija.php?id='.$myrow_k["id"].'</loc>
    <lastmod>'.date("Y-m-d", strtotime($myrow_k["lastmod_date"])).'</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>
  </url>';
}
echo '
</urlset>';

?>