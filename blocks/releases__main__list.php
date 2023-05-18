<?php 
// 2023-05-17
// визначаю загальну кількість записів у запиті
$result_vydannya_count = mysql_query ("SELECT COUNT(DISTINCT vydannya.id) FROM view, kompozycija, vydannya, vydavnyk WHERE view.kompozycija = kompozycija.id AND kompozycija.vydannya = vydannya.id AND vydannya.vydavnyk = vydavnyk.id AND vydannya.vydavnyk != ''", $db);
verification_query_2($result_vydannya_count);
$myrow_vydannya_count = mysql_fetch_array($result_vydannya_count);
$vydannya_count = $myrow_vydannya_count[0];
//echo "<p>всього записів у vydannya_count - $vydannya_count</p>";

$result_release_type = mysql_query ("SELECT DISTINCT vydannya.type, release_type.name FROM view, kompozycija, vydannya, release_type WHERE view.kompozycija = kompozycija.id AND kompozycija.vydannya = vydannya.id AND vydannya.type = release_type.id ORDER BY release_type.name ", $db); 
verification_query_2($result_release_type);

echo '<ul class="types__list">';
while ($myrow_release_type = mysql_fetch_array($result_release_type)) 
{
  $release_type_id = $myrow_release_type["type"];
  if ($release_type_id != "")
  {
    $result_vydannya = mysql_query ("SELECT DISTINCT vydannya.id, vydannya.title, vydannya.rik, vydavnyk.title AS vydavnyk FROM view, kompozycija, vydannya, vydavnyk WHERE view.kompozycija = kompozycija.id AND kompozycija.vydannya = vydannya.id AND vydannya.type = '$release_type_id' AND vydannya.vydavnyk = vydavnyk.id ORDER BY vydannya.title", $db); 
    verification_query_2($result_vydannya);
    echo '
    <li>
      <h2 class="">'.$myrow_release_type["name"].'</h2>
      <ul class="releases__list">';
      while ($myrow_vydannya = mysql_fetch_array($result_vydannya))
      {
        echo '
        <li class="release__item">
          <a class="relese__link" href="release.php?id='.$myrow_vydannya["id"].'">'.$myrow_vydannya["title"].' / '.$myrow_vydannya["vydavnyk"].', '.$myrow_vydannya["rik"].' рік'.'</a>
        </li>';
      }
      echo '
      </ul>
    </li>';
  }
}
echo '
  </ul>
  ';
?>